<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;

class LotoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'user'      => new UserResource($this->user),
            'bid'       => $this->bid,
            'game_id'   => $this->game_id
        ];
    }
}