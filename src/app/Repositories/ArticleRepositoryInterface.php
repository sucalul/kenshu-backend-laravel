<?php

namespace App\Repositories;

use App\Entities\ArticleEntity;

interface ArticleRepositoryInterface
{
    public function create(
        int $user_id,
        string $title,
        string $body,
    );

    public function findById(int $id): ?ArticleEntity;
}
