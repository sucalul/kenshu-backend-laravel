<?php

namespace App\Repositories;

interface ArticleRepositoryInterface
{
    public function create(
        int $user_id,
        string $title,
        string $body,
    );

    public function findById(int $id);
}
