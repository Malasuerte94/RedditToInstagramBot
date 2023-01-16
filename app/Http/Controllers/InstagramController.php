<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Services\Instagram\InstagramService;
use Illuminate\Http\Request;

class InstagramController extends Controller
{
    public function __construct(protected readonly InstagramService $instagramService)
    {
           
    }

    public function postInstagramMedia(Request $request)
    {
        $post = Post::findOrfail($request->post_id);
        $this->instagramService->uploadPostToInstagram($post);

    }
}
