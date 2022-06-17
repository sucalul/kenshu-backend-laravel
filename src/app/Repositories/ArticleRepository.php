<?php

namespace App\Repositories;

use App\Entities\ArticleEntity;
use App\Entities\UserEntity;
use App\Models\Article as ArticleModel;


class ArticleRepository implements ArticleRepositoryInterface
{
    protected ArticleModel $articleModel;

    public function __construct(
        ArticleModel $articleModel,
    )
    {
        $this->ArticleModel = $articleModel;
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

    public function findById(int $id): ?ArticleEntity
    {
        $article = ArticleModel::with(['user'])->get()->find($id);
        return !is_null($article) ? new ArticleEntity($article->toArray()) : null;
    }

    public function update(int $id, string $title, string $body): bool
    {
        $article = ArticleModel::where('id', $id)->update([
            'title' => $title,
            'body' => $body
        ]);
        return $article === 1;
    }
}
