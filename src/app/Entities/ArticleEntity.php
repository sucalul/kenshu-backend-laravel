<?php

namespace App\Entities;

class ArticleEntity
{
    public int $id;
    public string $title;
    public string $body;
    public int $user_id;

    function __construct(
        int    $id,
        string $title,
        string $body,
        int    $user_id,
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->user_id = $user_id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    function getUserId(): int
    {
        return $this->user_id;
    }
}
