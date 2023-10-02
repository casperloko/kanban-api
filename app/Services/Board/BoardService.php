<?php

namespace App\Services\Board;

use App\DTO\BoardDTO;
use App\Models\Board;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BoardService
{
    public function store(BoardDTO $dto)
    {
        $board = Board::create([
            'name' => $dto->name,
            'user_id' => $dto->userId
        ]);

        return $board;
    }

    public function update(BoardDTO $dto)
    {

        $board = Board::find($dto->id);

        $board->name = $dto->name;
        $board->save();

        return $board;
    }

    public function delete(int $userId, int $boardId)
    {
        $board = Board::find($boardId);

//        if (empty($board)) {
//            throw new ModelNotFoundException('Board not found by User');
//        }

        $board->delete();
    }

}
