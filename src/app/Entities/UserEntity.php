<?php

namespace App\Entities;

class UserEntity
{
    public int $id;
    public string $name;

    function __construct(array $list)
    {
        $this->id = $list['id'];
        $this->name = $list['name'];
    }
}
