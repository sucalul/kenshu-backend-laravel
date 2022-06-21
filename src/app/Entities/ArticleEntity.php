<?php

namespace App\Entities;

class ArticleEntity
{
    public int $id;
    public string $title;
    public string $body;
    public string $thumbnail_image_name;
    public UserEntity $user;
    /** ArticleImageEntity[] */
    public array $article_images;

    function __construct(array $list)
    {
        $this->id = $list['id'];
        $this->title = $list['title'];
        $this->body = $list['body'];
        $this->thumbnail_image_name = $list['thumbnail_image']['resource_id'];
        $this->user = new UserEntity($list['user']);
        $this->article_image = $this->getImagesOtherThanThumbnail($list);
    }

    private function getImagesOtherThanThumbnail(array $list): array
    {
        $image_list = array();
        $thumbnail_image_name = $list['thumbnail_image']['resource_id'];
        foreach ($list['images'] as $image) {
            $article_image = new ArticleImageEntity($image);
            if ($article_image->image_name === $thumbnail_image_name) {
                continue;
            }
            $image_list[] = $article_image;
        }
        return $image_list;
    }
}
