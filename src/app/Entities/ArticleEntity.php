<?php

namespace App\Entities;

class ArticleEntity
{
    public int $id;
    public string $title;
    public string $body;
    public string $thumbnail_image_id;
    public UserEntity $user;
    public array $article_image;

    function __construct(array $list)
    {
        $this->id = $list['id'];
        $this->title = $list['title'];
        $this->body = $list['body'];
        $this->thumbnail_image_id = $list['thumbnail_image']['resource_id'];
        $this->user = new UserEntity($list['user']);
        $this->article_image = $this->getUniqueImages($list);
    }

    // サムネイル以外の画像を取得
    private function getUniqueImages(array $list): array
    {
        $image_list = array();
        $thumbnail_image_resource_id = $list['thumbnail_image']['resource_id'];
        foreach ($list['images'] as $image) {
            $article_image = new ArticleImageEntity($image);
            // サムネイル画像idと一致する画像はここで排除
            if ($article_image->resource_id === $thumbnail_image_resource_id) {
                continue;
            }
            $image_list[] = $article_image;
        }
        return $image_list;
    }
}
