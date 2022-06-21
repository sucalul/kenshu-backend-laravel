<?php

namespace App\Services;

use App\Entities\TagEntity;
use App\Repositories\TagRepositoryInterface;

class TagService
{
    protected TagRepositoryInterface $tagRepositoryInterface;

    public function __construct(
        TagRepositoryInterface $tagRepositoryInterface
    )
    {
        $this->tagRepositoryInterface = $tagRepositoryInterface;
    }

    /**
     * @return TagEntity[]
     */
    public function findAll(): array
    {
        return $this->tagRepositoryInterface->findAll();
    }
}
