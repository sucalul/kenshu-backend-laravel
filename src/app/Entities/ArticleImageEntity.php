<?php

namespace App\Entities;


class ArticleImageEntity
{
    public int $id;
    public int $article_id;
    public string $image_name;

    function __construct(array $list)
    {
        $this->id = $list['id'];
        $this->article_id = $list['article_id'];
        $this->image_name = $list['resource_id'];
    }
}
