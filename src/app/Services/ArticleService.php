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
//        array $resources,
//        string $thumbnail_resource,
//        array $tags
    )
    {
        return $this->ArticleDataAccess->create(
            $user_id,
            $title,
            $body,
//            $resources,
//            $thumbnail_resource,
//            $tags
        );
    }
}
