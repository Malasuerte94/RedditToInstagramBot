<?php

namespace App\Http\Controllers;

use App\Http\Resources\HashtagCollection;
use App\Models\Hashtag;
use App\Models\Log;
use App\Models\User;
use App\Services\LogService;
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
        $hashtags = HashtagCollection::collection($user->hashtags);

        return response()->json([
            'data' => $hashtags
        ], 200);
        
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'hashtags' => 'required|string',
            'name' => 'required|string',
        ]);

        $created = Hashtag::create(
            [  
                'user_id' => auth()->user()->id,
                'name' => $validated['name'],
                'hashtags' => $validated['hashtags'],
            ]
        );

        LogService::log(
            [
                'type' => Log::TYPE_SUCCESS,
                'model' => Hashtag::class,
                'model_id' => $created->id,
                'message' => 'Hashtag created successfully',
                'data' => json_encode($validated),
            ]
        );

        return response()->json([
            'message' => 'Hashtag created successfully'
        ], 201);
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
