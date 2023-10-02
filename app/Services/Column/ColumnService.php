<?php

namespace App\Services\Column;

use App\DTO\ColumnDTO;
use App\Models\Board;
use App\Models\Column;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ColumnService
{
    public function store(ColumnDTO $dto)
    {
        $column = Column::create([
            'name' => $dto->name,
            'board_id' => $dto->boardId
        ]);

        return $column;
    }

    public function update(ColumnDTO $dto)
    {
        $column = Column::find($dto->id);

        $column->name = $dto->name;
        $column->save();

        return $column;
    }

    public function delete(int $columnId)
    {
        $column = Column::find($columnId);

        $column->delete();
    }

}
