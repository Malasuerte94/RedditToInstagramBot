<?php

namespace App\Http\Controllers;

use App\Http\Resources\RedditAutomationCollection;
use App\Models\RedditAutomation;
use App\Services\Reddit\RedditService;
use Illuminate\Http\Request;

class RedditAutomationController extends Controller
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
        $automations = RedditAutomationCollection::collection($user->redditAutomations);

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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = auth()->user();
        $validated = $request->validate([
            'ig_account_id' => 'required|int',
            'reddit_scraper_id' => 'required|int',
            'hashtag_id' => 'required|int',
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
        if($user->hashtags->where('id', $validated['hashtag_id'])->isEmpty()) {
            return response()->json([
                'message' => 'You do not own this hashtag.'
            ], 403);
        }

        $redditAutomation = RedditAutomation::create(
            [
                'user_id' => $user->id,
                'ig_account_id' => $validated['ig_account_id'],
                'reddit_scraper_id' => $validated['reddit_scraper_id'],
                'hashtag_id' => $validated['hashtag_id'],
            ]
        );

        return response()->json([
            'data' => $redditAutomation
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RedditAutomation  $redditAutomation
     * @return \Illuminate\Http\Response
     */
    public function show(RedditAutomation $redditAutomation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RedditAutomation  $redditAutomation
     * @return \Illuminate\Http\Response
     */
    public function edit(RedditAutomation $redditAutomation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RedditAutomation  $redditAutomation
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id): \Illuminate\Http\JsonResponse
    {
        //check if reddit automation is owned by user
        $user = auth()->user();
        if($user->redditAutomations->where('id', $id)->isEmpty()) {
            return response()->json([
                'message' => 'You do not own this Reddit automation.'
            ], 403);
        }

        $redditAutomation = RedditAutomation::findOrfail($id);
        $redditAutomation->active = $request->status;
        $redditAutomation->save();

        return response()->json(['message' => 'Done']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RedditAutomation  $redditAutomation
     * @return \Illuminate\Http\Response
     */
    public function destroy(RedditAutomation $redditAutomation)
    {
        //
    }

    public function testStart(Request $request, int $id): \Illuminate\Http\JsonResponse
    {
        $redditAutomation = RedditAutomation::findOrfail($id);
        
        $redditService = new RedditService($redditAutomation);
        $redditService->getLatestPosts();

        return response()->json(['message' => 'Done']);
    }
}
