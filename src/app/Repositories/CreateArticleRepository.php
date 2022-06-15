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
//    protected $ArticleImageModel;
//    protected $TagModel;


    public function __construct(
        ArticleModel $ArticleModel,
//        ArticleImageModel $ArticleImageModel,
//        TagModel $TagModel
    )
    {
        $this->ArticleModel = $ArticleModel;
//        $this->ArticleImageModel = $ArticleImageModel;
//        $this->TagModel = $TagModel;
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
//        DB::beginTransaction();

//        if (!DB::beginTransaction()) {
//            throw new \Exception('トランザクションがアクティブじゃないよ');
//        }

//        try {
            // 記事のinsert
            $article = ArticleModel::create([
                'user_id' => $user_id,
                'title' => $title,
                'body' => $body
            ]);

            // サムネイル画像をinsert
//            $thumbnail_image = ArticleImageModel::create([
//                'article_id' => $article->id,
//                'resource_id' => $thumbnail_resource,
//            ]);

            // サムネイル以外の画像をinsert
//            $this->createArticleImages($article->id, $resources);

            // tagをinsert
//            $this->createArticleTags($article->id, $tags);

            // 画像をいれたのでarticleの更新処理をする
//            $article->update([
//                'thumbnail_image_id' => $thumbnail_image->id,
//            ]);

//            DB::commit();
//        } catch (Exception $e) {
//            DB::rollBack();
//            throw $e;
//        }
    }
//
//    private function createArticleImages(
//        int $article_id,
//        array $resources
//    ){
//        $params = array();
//        for ($i = 0; $i < count($resources); $i++) {
//            $params[] = [
//                'article_id' => $article_id,
//                'resource_id' => $resources[$i]
//            ];
//        }
//        ArticleImageModel::insert($params);
//    }
//
//    private function createArticleTags(
//        int $article_id,
//        array $tags
//    ) {
//        $params = array();
//        for ($i = 0; $i < count($tags); $i++) {
//            $params[] = [
//                'article_id' => $article_id,
//                'tag_id' => $tags[$i],
//            ];
//        }
//        TagModel::insert($params);
//    }
}
