<?php

namespace App\Entities;


class ArticleEntity
{
    public int $id;
    public string $title;
    public string $body;
    public string $thumbnail_image_id;
    public UserEntity $user;
    public ArticleImageEntity $article_image;

    function __construct(array $list)
    {
        $this->id = $list['id'];
        $this->title = $list['title'];
        $this->body = $list['body'];
        $this->thumbnail_image_id = $list['thumbnail_image_id'];
        $this->user = new UserEntity($list['user']);
        $this->article_image = new ArticleImageEntity($list['thumbnail_image']);
    }
}
