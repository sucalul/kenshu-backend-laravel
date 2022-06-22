<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Entities\ArticleEntity;
use App\Models\Article as ArticleModel;
use App\Models\ArticleImage as ArticleImageModel;
use App\Models\ArticleTag as ArticleTagModel;

class ArticleRepository implements ArticleRepositoryInterface
{
    private ArticleModel $articleModel;
    private ArticleImageModel $articleImageModel;
    private ArticleTagModel $articleTagModel;

    public function __construct(
        ArticleModel      $articleModel,
        ArticleImageModel $articleImageModel,
        ArticleTagModel   $articleTagModel
    )
    {
        $this->articleModel = $articleModel;
        $this->articleImageModel = $articleImageModel;
        $this->articleTagModel = $articleTagModel;
    }

    /**
     * @return ArticleEntity[]
     */
    public function findAll(): array
    {
        $articleList = array();
        $articles = $this->articleModel::with('user', 'thumbnail_image', 'images', 'tags')->get()->sortBy('created_at');
        foreach ($articles as $article) {
            $articleList[] = new ArticleEntity($article->toArray());
        }
        return $articleList;
    }

    public function create(
        int    $user_id,
        string $title,
        string $body,
        array  $resources,
        string $thumbnail_resource,
        array  $tags
    )
    {
        DB::transaction(function () use (
            $user_id,
            $title,
            $body,
            $resources,
            $thumbnail_resource,
            $tags
        ) {
            $article = $this->articleModel::create([
                'user_id' => $user_id,
                'title' => $title,
                'body' => $body,
            ]);
            // サムネイル画像をinsert
            $thumbnail_image = $this->articleImageModel::create([
                'article_id' => $article->id,
                'resource_id' => $thumbnail_resource,
            ]);
            // サムネイル以外の画像をinsert
            $this->createArticleImages($article->id, $resources);
            $this->createArticleTags($article->id, $tags);
            // 画像をいれたのでarticleの更新処理をする
            $article->update([
                'thumbnail_image_id' => $thumbnail_image->id,
            ]);

            DB::commit();
        }
        );
    }

    public function findById(int $id): ?ArticleEntity
    {
        $article = ArticleModel::with(['user', 'thumbnail_image', 'images', 'tags'])->get()->find($id);
        return !is_null($article) ? new ArticleEntity($article->toArray()) : null;
    }

    public function update(
        int    $id,
        string $title,
        string $body,
        array  $resources,
        string $thumbnail_resource
    ): bool
    {
        DB::transaction(function () use (
            $id,
            $title,
            $body,
            $resources,
            $thumbnail_resource,
        ) {
            $this->createArticleImages($id, $resources);
            $exists_thumbnail_image = $this->articleImageModel->where('resource_id', $thumbnail_resource)->first(['id']);
            if (is_null($exists_thumbnail_image)) {
                $thumbnail_image = $this->articleImageModel::create([
                    'article_id' => $id,
                    'resource_id' => $thumbnail_resource,
                ]);
                $this->articleModel::where('id', $id)->update([
                    'title' => $title,
                    'body' => $body,
                    'thumbnail_image_id' => $thumbnail_image->id
                ]);
            } else {
                $this->articleModel::where('id', $id)->update([
                    'title' => $title,
                    'body' => $body,
                    'thumbnail_image_id' => $exists_thumbnail_image->id,
                ]);
            }

            DB::commit();
        }
        );
        return true;
    }

    public function destroy(int $id): bool
    {
        $article = ArticleModel::where('id', $id)->delete();
        return $article === 1;
    }

    // private functions
    private function createArticleImages(
        int   $article_id,
        array $resources
    )
    {
        $params = array();
        for ($i = 0; $i < count($resources); $i++) {
            $params[] = [
                'article_id' => $article_id,
                'resource_id' => $resources[$i],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }
        $this->articleImageModel::insert($params);
    }

    private function createArticleTags(
        int   $article_id,
        array $tags
    )
    {
        $params = [];
        for ($i = 0; $i < count($tags); $i++) {
            $params[] = [
                'article_id' => $article_id,
                'tag_id' => $tags[$i]
            ];
        }
        $this->articleTagModel::insert($params);
    }
}
