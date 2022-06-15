<?php

namespace App\Repositories;

use App\Repositories\ArticleRepositoryInterface;
use App\Models\Article AS ArticleModel;


class ArticleRepository implements ArticleRepositoryInterface
{
    protected $ArticleModel;


    public function __construct(
        ArticleModel $ArticleModel,
    )
    {
        $this->ArticleModel = $ArticleModel;
    }

    public function create(
        int    $user_id,
        string $title,
        string $body,
    )
    {
        $article = ArticleModel::create([
            'user_id' => $user_id,
            'title' => $title,
            'body' => $body
        ]);
    }

    public function findById(int $id) {
        // TODO: 記事詳細を作る時に書く
    }
}
