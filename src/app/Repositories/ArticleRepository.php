<?php

namespace App\Repositories;

use App\Entities\ArticleDetailEntity;
use App\Models\Article as ArticleModel;


class ArticleRepository implements ArticleRepositoryInterface
{
    protected ArticleModel $ArticleModel;

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

    public function findById(int $id): ArticleDetailEntity
    {
        $article = ArticleModel::with(['user'])->get()->find($id);
        return new ArticleDetailEntity($article);
    }
}
