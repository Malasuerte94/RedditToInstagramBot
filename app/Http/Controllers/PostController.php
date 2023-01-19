<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Models\User;
use App\Services\Reddit\RedditService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {

        /** @var User $user */
        $user = auth()->user();
        $igAccounts = $user->igAccounts;
        $posts = [];

        foreach ($igAccounts as $igAccount) {
            $posts[$igAccount->username] = $igAccount->posts;
        }

        return response()->json($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $post = Post::findOrfail($id);

        switch ($request) {
            case isset($request->confirmed):
                $post->confirmed = $request->confirmed;
                $post->save();
                break;
            default:
                return response()->json(['message' => 'Action not allowed']);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $post = Post::findOrfail($id);
        $post->delete();
        return response()->json(['message' => 'Post deleted successfully']);
    }

}
