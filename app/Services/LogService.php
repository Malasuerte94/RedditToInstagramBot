<?php

namespace App\Services;


use App\Models\Log;
use App\Models\RedditAutomation;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class LogService
{
    public string|array|null $data;
    public string|null $message;
    public string $type;
    public string|array|null $exception;
    public User $user;
    public Model $model;

    /**
     * Connecting to the server and retrieving the token
     * @return void
     */
    public static function log($data): void
    {
        Log::create([
            'type' => $data['type'] ?? '',
            'model' => $data['model'] ?? '',
            'model_id' => $data['model_id'] ?? null,
            'message' => $data['message'] ?? '',
            'data' => $data['data'] ?? '',
            'exception' => array_key_exists('exception', $data) ? json_encode($data['exception']) : json_encode([]),
        ]);

    }
}
