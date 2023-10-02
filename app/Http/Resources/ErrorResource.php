<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceResponse;

class ErrorResource extends JsonResource
{
    public function toArray($request)
    {
        return [
//            'message' => $this->getMessage(),
//            'errors' => $this->getString()
        ];
    }

//    public function toResponse($request)
//    {
//        return (new ResourceResponse($this))->toResponse($request)->setStatusCode(422);
//    }
}
