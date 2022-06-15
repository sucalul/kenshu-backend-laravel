<?php

namespace App\Entities;


class CreateArticleEntity {
    protected int $user_id;
    protected string $title;
    protected string $body;
    protected array $resources;
    protected string $thumbnail_resource;
    protected array $tags;

    function __construct(
        int $user_id,
        string $title,
        string $body,
        array $resources,
        string $thumbnail_resource,
        array $tags
    )
    {
        $this->user_id = $user_id;
        $this->title = $title;
        $this->body = $body;
        $this->resources = $resources;
        $this->thumbnail_resource = $thumbnail_resource;
        $this->tags = $tags;
    }
}
