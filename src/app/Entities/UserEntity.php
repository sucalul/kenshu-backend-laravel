<?php

namespace App\Entities;

class UserEntity
{
    public int $id;
    public string $name;

    function __construct(
        int    $id,
        string $name,
    )
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

}
