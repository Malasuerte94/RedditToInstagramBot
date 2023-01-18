<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RedditScraperCollection extends JsonResource
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
            'subreddit' => $this->subreddit,
            'filter_by' => $this->filter_by,
            'time_filter' => $this->time_filter,
            'limit' => $this->limit,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
