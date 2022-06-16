<?php

namespace App\Entities;


class ArticleEntity
{
    public int $id;
    public string $title;
    public string $body;
    public UserEntity $user;

    function __construct(array $list)
    {
        $this->id = $list['id'];
        $this->title = $list['title'];
        $this->body = $list['body'];
        $this->user = new UserEntity($list['user']);
    }
}
