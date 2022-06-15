<?php

namespace App\Entities;

class ArticleDetailEntity
{
    public int $id;
    public string $title;
    public string $body;
    public string $user_name;

    function __construct(object $article)
    {
        $this->id = $article['id'];
        $this->title = $article['title'];
        $this->body = $article['body'];
        $this->user_name = $article->user['name'];
    }
}
