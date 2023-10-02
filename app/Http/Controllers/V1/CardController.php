<?php

namespace App\Http\Controllers\V1;

use App\DTO\CardDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\CardCreateRequest;
use App\Http\Requests\CardDeleteRequest;
use App\Http\Requests\CardUpdateRequest;
use App\Http\Resources\CardResource;
use App\Http\Resources\ColumnResource;
use App\Models\Card;
use App\Services\Card\CardService;
use Illuminate\Http\Request;

class CardController extends Controller
{
    protected $service;

    public function __construct(CardService $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }

    public function store(CardCreateRequest $request, Card $card)
    {
        $dto = new CardDTO(
            null,
            $request->name,
            $request->description,
            auth()->id(),
            $request->boards,
            $request->columns
        );

        $card = $this->service->store($dto);

        return new CardResource($card);
    }

    public function update(CardUpdateRequest $request, Card $card)
    {
        $dto = new CardDTO(
            $request->id,
            $request->name,
            $request->description,
            auth()->id(),
            $request->boards,
            $request->columnId
        );

        $card = $this->service->update($dto);

        return new CardResource($card);
    }

    public function destroy(CardDeleteRequest $request)
    {
        $column = $this->service->delete(auth()->id(),$request->boards ,$request->id);

        return response()->json(['message' => 'Ok'], 204);
    }
}
