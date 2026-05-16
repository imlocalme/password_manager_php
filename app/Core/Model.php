<?php

declare(strict_types=1);

namespace App\Core;

abstract class Model
{
    protected string $table;
    protected string $primaryKey = 'id';

    public function find(int $id): ?array
    {
        $row = Database::query("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id", ['id' => $id])->fetch();
        return $row ?: null;
    }

    public function allByUser(int $userId): array
    {
        return Database::query("SELECT * FROM {$this->table} WHERE user_id = :uid", ['uid' => $userId])->fetchAll();
    }
}
