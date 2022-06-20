<?php

namespace App\Services;

use App\Entities\ArticleEntity;
use App\Exceptions\NotFoundException;
use App\Repositories\ArticleRepositoryInterface;
use Exception;

class ArticleService
{
    protected ArticleRepositoryInterface $articleRepositoryInterface;

    public function __construct(
        ArticleRepositoryInterface $articleRepositoryInterface
    )
    {
        $this->articleRepositoryInterface = $articleRepositoryInterface;
    }

    public function findAll(): array
    {
        return $this->articleRepositoryInterface->findAll();
    }

    public function create(
        int    $user_id,
        string $title,
        string $body,
        array  $resources,
        string $thumbnail_resource
    )
    {
        return $this->articleRepositoryInterface->create(
            $user_id,
            $title,
            $body,
            $resources,
            $thumbnail_resource
        );
    }

    public function findById(int $id): ?ArticleEntity
    {
        return $this->articleRepositoryInterface->findById($id);
    }

    public function update(int $id, string $title, string $body): bool
    {
        $article = $this->articleRepositoryInterface->findById($id);
        if (!$article) {
            throw new NotFoundException();
        }
        $is_update_success = $this->articleRepositoryInterface->update($id, $title, $body);
        if (!$is_update_success) {
            throw new Exception();
        }
        return true;
    }

    public function destroy(int $id): bool
    {
        $article = $this->articleRepositoryInterface->findById($id);
        if (!$article) {
            throw new NotFoundException();
        }
        $is_deleted_success = $this->articleRepositoryInterface->destroy($id);
        if (!$is_deleted_success) {
            throw new Exception();
        }
        return true;
    }
}
