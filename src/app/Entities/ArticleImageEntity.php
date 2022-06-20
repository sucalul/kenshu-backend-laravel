<?php

namespace App\Entities;


class ArticleImageEntity
{
    public int $id;
    public int $article_id;
    public string $resource_id;

    function __construct(array $list)
    {
        $this->id = $list['id'];
        $this->article_id = $list['article_id'];
        $this->resource_id = $list['resource_id'];
    }
}
