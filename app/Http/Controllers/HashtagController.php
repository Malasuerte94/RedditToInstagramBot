<?php

namespace App\Http\Controllers;

use App\Http\Resources\HashtagCollection;
use App\Models\Hashtag;
use App\Models\User;
use Illuminate\Http\Request;

class HashtagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $hashtags = collect();
        $igAccounts = $user->igAccounts;
        
        foreach ($igAccounts as $igAccount) {
            $hashtags[] = new HashtagCollection(($igAccount->hashtag));
        }

        return response()->json([
            'data' => $hashtags
        ], 200);
        
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
        $validated = $request->validate([
            'hashtags' => 'required|string',
            'ig_account_id' => 'required|int',
        ]);

        $hashtags = Hashtag::create(
            [
                'hashtags' => $validated['hashtags'],
                'ig_account_id' => $validated['ig_account_id'],
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hashtag  $hashtag
     * @return \Illuminate\Http\Response
     */
    public function show(Hashtag $hashtag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hashtag  $hashtag
     * @return \Illuminate\Http\Response
     */
    public function edit(Hashtag $hashtag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hashtag  $hashtag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hashtag $hashtag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hashtag  $hashtag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hashtag $hashtag)
    {
        //
    }
}
