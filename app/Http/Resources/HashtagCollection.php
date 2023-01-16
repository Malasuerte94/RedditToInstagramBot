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
            'hashtags' => $this->hashtags,
            'ig_account_id' => $this->ig_account_id,
            'ig_username' => $this->igAccount->username,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
