<?php

namespace App\Repositories;

use App\Entities\TagEntity;
use App\Models\Tag as TagModel;


class TagRepository implements TagRepositoryInterface
{
    private TagModel $tagModel;

    public function __construct(TagModel $tagModel)
    {
        $this->tagModel = $tagModel;
    }

    /**
     * @return TagEntity[]
     */
    public function findAll(): array
    {
        $tagList = array();
        $tags = $this->tagModel->get();
        foreach ($tags as $tag) {
            $tagList[] = new TagEntity($tag->toarray());
        }
        return $tagList;
    }
}
