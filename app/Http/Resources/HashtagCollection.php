<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HashtagCollection extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'hashtags' => $this->hashtags,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
