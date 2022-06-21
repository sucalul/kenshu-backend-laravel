<?php

namespace App\Entities;

use Symfony\Component\VarDumper\VarDumper;

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
        $list_images = $list['images'];
        $thumbnail_image_resource_id = $list['thumbnail_image']['resource_id'];
        $image_list = array();
        foreach ($list_images as $l) {
            $article_image = new ArticleImageEntity($l);
            // サムネイル画像idと一致する画像はここで排除
            if ($article_image->resource_id === $thumbnail_image_resource_id) {
                continue;
            }
            $image_list[] = $article_image;
        }
        return $image_list;
    }
}
