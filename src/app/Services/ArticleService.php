<?php

namespace App\Services;

use App\Repositories\ArticleRepositoryInterface;

class ArticleService
{
    protected ArticleRepositoryInterface $ArticleRepositoryInterface;

    public function __construct(ArticleRepositoryInterface $ArticleRepositoryInterface)
    {
        $this->ArticleRepositoryInterface = $ArticleRepositoryInterface;
    }

    public function create(
        int $user_id,
        string $title,
        string $body,
    )
    {
        return $this->ArticleRepositoryInterface->create(
            $user_id,
            $title,
            $body,
        );
    }

    public function findById(int $id) {
        return $this->ArticleRepositoryInterface->findById($id);
    }
}
