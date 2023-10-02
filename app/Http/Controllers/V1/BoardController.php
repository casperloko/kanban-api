<?php

namespace App\Http\Controllers\V1;

use App\DTO\BoardDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\BoardCreateRequest;
use App\Http\Requests\BoardDeleteRequest;
use App\Http\Requests\BoardShowRequest;
use App\Http\Requests\BoardUpdateRequest;
use App\Http\Resources\BoardResource;
use App\Http\Resources\BoardsResource;
use App\Http\Resources\ErrorResource;
use App\Models\Board;
use App\Models\User;
use App\Services\Board\BoardService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    protected $service;

    public function __construct(BoardService $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }

    public function index()
    {
        $user = User::find(auth()->id());

        return BoardsResource::collection($user->boards);
    }

    public function show(BoardShowRequest $request)
    {
        $board = Board::find($request->id);

        return new BoardResource($board);
    }

    public function store(BoardCreateRequest $request, Board $board)
    {
        $dto = new BoardDTO(
            null,
            $request->name,
            auth()->id()
        );

        $board = $this->service->store($dto);

        return new BoardResource($board);
    }

    public function update(BoardUpdateRequest $request, Board $board)
    {
        $dto = new BoardDTO(
            $request->id,
            $request->name,
            auth()->id()
        );

        $board = $this->service->update($dto);

        return new BoardResource($board);
    }

    public function destroy(BoardDeleteRequest $request)
    {

        $board = $this->service->delete(auth()->id(), $request->id);

        return response()->json([], 204);
    }
}
