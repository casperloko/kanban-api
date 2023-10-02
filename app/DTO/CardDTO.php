<?php

namespace App\DTO;

class CardDTO
{
    public function __construct(
        public ?int $id,
        public string $name,
        public ?string $description,
        public int $userId,
        public int $boardId,
        public int $columnId
    )
    {
    }
}
