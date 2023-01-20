<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
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
