<?php

namespace App\Http\Controllers\V1;

use App\DTO\ColumnDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\ColumnCreateRequest;
use App\Http\Requests\ColumnDeleteRequest;
use App\Http\Requests\ColumnUpdateRequest;
use App\Http\Resources\ColumnResource;
use App\Http\Resources\ErrorResource;
use App\Models\Column;
use App\Services\Column\ColumnService;
use Illuminate\Http\Request;

class ColumnController extends Controller
{
    protected $service;

    public function __construct(ColumnService $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }

    public function store(ColumnCreateRequest $request, Column $column)
    {
        $dto = new ColumnDTO(
            null,
            $request->name,
            auth()->id(),
            $request->boards
        );

        $column = $this->service->store($dto);

        return new ColumnResource($column);
    }

    public function update(ColumnUpdateRequest $request, Column $column)
    {
        $dto = new ColumnDTO(
            $request->id,
            $request->name,
            auth()->id(),
            $request->boards
        );

        $column = $this->service->update($dto);

        return new ColumnResource($column);
    }

    public function destroy(ColumnDeleteRequest $request)
    {
        $column = $this->service->delete($request->id);

        return response()->json([], 204);
    }
}
