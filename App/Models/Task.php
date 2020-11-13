<?php

declare(strict_types=1);

namespace App\Models;

use PDO;
use Src\Db;
use Src\Model;

class Task extends Model
{
    protected const TABLE_NAME = 'tasks';

    private static array $sortFields = [
        'name' => 'Имя',
        'email' => 'E-mail',
        'completed' => 'Выполнена',
    ];

    public ?int $id;

    public ?string $name;

    public ?string $email;

    public ?string $text;

    public ?int $completed;

    public ?int $edited;

    public static function getSortFields(): array
    {
        return self::$sortFields;
    }

    public static function create(string $name, string $email, string $text): self
    {
        $task = new self;

        $sql = 'INSERT INTO '
            . self::TABLE_NAME
            . ' (`name`, `email`, `text`, `completed`, `edited`)'
            . ' VALUES (:username, :email, :text, :completed, :edited)';

        $pdo = Db::getInstance()->pdo();

        $pdo->prepare($sql)->execute([
            ':email' => $task->email = $email,
            ':username' => $task->name = $name,
            ':text' => $task->text = $text,
            ':completed' => $task->edited = 0,
            ':edited' => $task->edited = 0,
        ]);

        $task->id = (int)$pdo->lastInsertId();

        return $task;
    }

    public function update(string $text, int $completed): self
    {
        $sql = 'UPDATE '
            . self::TABLE_NAME
            . ' SET text = :text, completed = :completed, edited = :edited WHERE id = :id';

        if ($this->edited === 0 && ! empty($text)) {
            $this->edited = $this->text === $text ? 0 : 1;
        }

        Db::getInstance()
            ->pdo()
            ->prepare($sql)
            ->execute([
                ':id' => $this->id,
                ':text' => $this->text = empty($text) ? $this->text : $text,
                ':completed' => $this->completed = $this->completed === 1 ? 1 : $completed,
                ':edited' => $this->edited,
            ]);

        return $this;
    }

    public static function findById(int $id): ?self
    {
        $sql = 'SELECT * FROM ' . self::TABLE_NAME . ' WHERE id = :id';

        $stmt = Db::getInstance()->pdo()->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch();
    }
}