<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        'id'        => $this->id,
        'name'      => $this->name,
        'image'     => $this->image,
        'city'      => $this->city,
        'is_active' => $this->is_active,
    }
}