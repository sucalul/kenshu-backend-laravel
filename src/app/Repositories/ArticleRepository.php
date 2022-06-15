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

    public function findById(int $id)
    {
        $article = ArticleModel::with(['user'])->get()->find($id);

        if (is_null($article)) {
            return null;
        }

        $article_entity = new ArticleEntity(
            id: $article->id,
            title: $article->title,
            body: $article->body,
            user_id: $article->user_id
        );
        $user_entity = new UserEntity(
            id: $article->user_id,
            name: $article->user->name
        );
        $obj_merged = (object)array_merge(
            (array)$article_entity,
            (array)$user_entity,
        );
        return $obj_merged;
    }
}
