<?php

declare(strict_types=1);

namespace Src;

use \InvalidArgumentException;
use PDO;

abstract class Model
{
    private const TABLE_NAME = '';

    public const PER_PAGE = 2;

    public static function count(): int
    {
        $sql = 'SELECT COUNT(*) FROM ' . static::TABLE_NAME;
        return Db::getInstance()->pdo()->query($sql)->fetch()[0];
    }

    public static function paginate(?string $orderBy, ?string $order, ?int $page): array
    {
        $orderBy ??= 'id';
        $order ??= 'asc';
        $page ??= 1;

        if (static::invalidOrder($order) || static::invalidOrderBy($orderBy)) {
            throw new InvalidArgumentException('Invalid $order or $orderBy.');
        }

        $sql = 'SELECT * FROM '
            . static::TABLE_NAME
            . ' ORDER BY '
            . $orderBy
            . ' '
            . $order
            . ' LIMIT '
            . static::PER_PAGE
            . ' OFFSET '
            . ($page - 1) * self::PER_PAGE;

        $stmt = Db::getInstance()->pdo()->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, static::class);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    protected static function invalidOrder(string $order): bool
    {
        return ! in_array((strtolower($order)), ['asc', 'desc'], true);
    }

    protected static function invalidOrderBy(string $orderBy): bool
    {
        return ! array_key_exists($orderBy, get_class_vars(static::class));
    }
}