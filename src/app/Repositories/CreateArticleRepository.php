<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

use App\Entities\CreateArticleEntity;
use App\Services\ArticleDataAccess;
use App\Models\Article AS ArticleModel;
use App\Models\ArticleImage AS ArticleImageModel;
use App\Models\Tag AS TagModel;


class CreateArticleRepository implements ArticleDataAccess
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
}
