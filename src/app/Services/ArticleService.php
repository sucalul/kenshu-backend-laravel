<?php

namespace App\Services;

class ArticleService
{
    protected ArticleDataAccess $ArticleDataAccess;

    public function __construct(ArticleDataAccess $ArticleDataAccess)
    {
        $this->ArticleDataAccess = $ArticleDataAccess;
    }

    public function create(
        int $user_id,
        string $title,
        string $body,
    )
    {
        return $this->ArticleDataAccess->create(
            $user_id,
            $title,
            $body,
        );
    }
}
