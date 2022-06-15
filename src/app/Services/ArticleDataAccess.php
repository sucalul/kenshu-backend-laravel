<?php

namespace App\Services;

interface ArticleDataAccess
{
    public function create(
        int $user_id,
        string $title,
        string $body,
    );
}
