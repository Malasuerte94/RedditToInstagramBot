<?php

namespace App\Http\Controllers;

use App\Http\Resources\InstagramAutomationCollection;
use App\Models\InstagramAutomation;
use App\Models\User;
use Illuminate\Http\Request;

class InstagramAutomationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $automations = InstagramAutomationCollection::collection($user->instagramAutomations);

        return response()->json([
            'data' => $automations
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = auth()->user();
        $validated = $request->validate([
            'ig_account_id' => 'required|int',
            'reddit_scraper_id' => 'required|int'
        ]);

        if($user->igAccounts->where('id', $validated['ig_account_id'])->isEmpty()) {
            return response()->json([
                'message' => 'You do not own this Instagram account.'
            ], 403);
        }
        if($user->redditScrapers->where('id', $validated['reddit_scraper_id'])->isEmpty()) {
            return response()->json([
                'message' => 'You do not own this Reddit scraper.'
            ], 403);
        }

        $instagramAutomation = InstagramAutomation::create(
            [
                'user_id' => $user->id,
                'ig_account_id' => $validated['ig_account_id'],
                'reddit_scraper_id' => $validated['reddit_scraper_id']
            ]
        );

        return response()->json([
            'data' => $instagramAutomation
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InstagramAutomation  $instagramAutomation
     * @return \Illuminate\Http\Response
     */
    public function show(InstagramAutomation $instagramAutomation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InstagramAutomation  $instagramAutomation
     * @return \Illuminate\Http\Response
     */
    public function edit(InstagramAutomation $instagramAutomation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InstagramAutomation  $instagramAutomation
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id): \Illuminate\Http\JsonResponse
    {
        $user = auth()->user();
        if($user->instagramAutomations->where('id', $id)->isEmpty()) {
            return response()->json([
                'message' => 'You do not own this Instagram Automation.'
            ], 403);
        }

        $instagramAutomation = InstagramAutomation::findOrfail($id);
        $instagramAutomation->active = $request->status;
        $instagramAutomation->save();

        return response()->json(['message' => 'Done']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InstagramAutomation  $instagramAutomation
     * @return \Illuminate\Http\Response
     */
    public function destroy(InstagramAutomation $instagramAutomation)
    {
        //
    }
}
