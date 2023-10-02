<?php

namespace App\DTO;

class BoardDTO
{
    public function __construct(
        public ?int $id,
        public string $name,
        public int $userId
    )
    {
    }
}
