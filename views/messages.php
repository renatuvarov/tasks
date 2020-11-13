<?php if (! empty($errors)): ?>
    <div class="w-25 ml-auto mr-auto mt-5 alert alert-danger">
        <hr>
        <?php foreach ($errors as $errorName => $errorSet): ?>
            <?php foreach ($errorSet as $error): ?>
                <p><?php echo htmlspecialchars($errorName), ': ', htmlspecialchars($error) ?></p>
            <?php endforeach; ?>
            <hr>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if (! empty($success)): ?>
    <div class="w-25 ml-auto mr-auto mt-5 alert alert-primary">
        <?php foreach ($success as $message): ?>
            <p><?php echo htmlspecialchars($message) ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>