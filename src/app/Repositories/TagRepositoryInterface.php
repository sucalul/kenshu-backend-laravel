<?php

namespace App\Repositories;

use App\Entities\TagEntity;

interface TagRepositoryInterface
{
    /**
     * @return TagEntity[]
     */
    public function findAll(): array;
}
