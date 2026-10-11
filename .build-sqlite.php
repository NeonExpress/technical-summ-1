<?php

declare(strict_types=1);

$source = new mysqli('localhost', 'root', '', 'cud', 3306);
$source->set_charset('utf8mb4');

$targetPath = __DIR__ . '/writable/database.sqlite';

if (is_file($targetPath) && ! unlink($targetPath)) {
    throw new RuntimeException('Unable to replace the existing SQLite database.');
}

$target = new PDO('sqlite:' . $targetPath, null, null, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

$target->exec(<<<'SQL'
CREATE TABLE tasks (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    status TEXT NOT NULL DEFAULT 'pending',
    task_date TEXT NOT NULL,
    created_at TEXT NOT NULL
);

CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL,
    full_name TEXT NOT NULL,
    email TEXT NOT NULL,
    created_at TEXT NOT NULL
);
SQL);

$target->beginTransaction();

$taskInsert = $target->prepare(
    'INSERT INTO tasks (id, title, status, task_date, created_at)
     VALUES (:id, :title, :status, :task_date, :created_at)'
);
$tasks = $source->query('SELECT id, title, status, task_date, created_at FROM tasks ORDER BY id');

while ($task = $tasks->fetch_assoc()) {
    $taskInsert->execute($task);
}

$userInsert = $target->prepare(
    'INSERT INTO users (id, username, full_name, email, created_at)
     VALUES (:id, :username, :full_name, :email, :created_at)'
);
$users = $source->query('SELECT id, username, full_name, email, created_at FROM users ORDER BY id');

while ($user = $users->fetch_assoc()) {
    $userInsert->execute($user);
}

$target->commit();

echo 'Created ' . $targetPath . PHP_EOL;
echo 'Tasks: ' . $target->query('SELECT COUNT(*) FROM tasks')->fetchColumn() . PHP_EOL;
echo 'Users: ' . $target->query('SELECT COUNT(*) FROM users')->fetchColumn() . PHP_EOL;
