<?php

namespace App\Http\Controllers;

use App\Services\Instagram\InstagramService;
use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getInstagramAuthData()
    {
        $user = auth()->user();
        if ($user) {
            $instagramService = new InstagramService($user);
        }
        
        return response()->json([
            'message' => 'Instagram data refreshed',
        ]);
    }
}
