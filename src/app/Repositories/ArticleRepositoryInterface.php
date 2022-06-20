<?php

namespace App\Repositories;

use App\Entities\ArticleEntity;
use Ramsey\Uuid\Type\Integer;

interface ArticleRepositoryInterface
{
    public function create(
        int    $user_id,
        string $title,
        string $body,
    );

    public function findById(int $id): ?ArticleEntity;

    public function update(int $id, string $title, string $body): bool;
}
