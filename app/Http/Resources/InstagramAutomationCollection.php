<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class InstagramAutomationCollection extends JsonResource
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
            'instagram' => $this->igAccount->username,
            'subreddit' => $this->redditScraper->subreddit,
            'active' => $this->active,
            'created_at' => Carbon::parse($this->created_at)->format('d-m-Y H:i:s'),
        ];
    }
}
