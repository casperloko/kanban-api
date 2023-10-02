<?php

namespace App\DTO;

class ColumnDTO
{
    public function __construct(
        public ?int $id,
        public string $name,
        public int $userId,
        public int $boardId
    )
    {
    }
}
