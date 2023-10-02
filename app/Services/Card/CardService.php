<?php

namespace App\Services\Card;

use App\DTO\CardDTO;
use App\Models\Board;
use App\Models\Card;
use App\Models\Column;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CardService
{
    public function store(CardDTO $dto)
    {
        $card = Card::create([
            'name' => $dto->name,
            'description' => $dto->description,
            'column_id' => $dto->columnId
        ]);

        return $card;
    }

    public function update(CardDTO $dto)
    {

        $card = Card::find($dto->id);

        if ($card->column->board_id != Column::find($dto->columnId)->board_id) {
            throw new ModelNotFoundException('Board not found', 422);
        }

        $card->name = $dto->name;
        $card->description = $dto->description;
        $card->column_id = $dto->columnId;

        $card->save();

        return $card;
    }

    public function delete(int $userId, int $boardId, int $cardId)
    {
        $card = Card::find($cardId);

        if ($card->column->board_id != $boardId) {
            throw new ModelNotFoundException('Board not found', 422);
        }

        $card->delete();
    }

}
