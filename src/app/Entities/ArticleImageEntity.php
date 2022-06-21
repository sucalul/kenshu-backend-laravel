<?php

namespace App\Entities;


class ArticleImageEntity
{
    public int $id;
    public int $article_id;
    public string $image_name;

    function __construct(array $images)
    {
        $this->id = $images['id'];
        $this->article_id = $images['article_id'];
        $this->image_name = $images['resource_id'];
    }
}
