<?php

namespace App\Entities;


class ArticleImageEntity
{
    public int $id;
    public int $article_id;
    public string $resource_id;

    function __construct(array $images)
    {
        $this->id = $images['id'];
        $this->article_id = $images['article_id'];
        $this->resource_id = $images['resource_id'];
    }
}
