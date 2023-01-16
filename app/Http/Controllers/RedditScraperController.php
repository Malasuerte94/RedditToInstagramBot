<?php

namespace App\Http\Controllers;

use App\Http\Resources\RedditScraperCollection;
use App\Models\RedditScraper;
use App\Models\User;
use Illuminate\Http\Request;

class RedditScraperController extends Controller
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
        $redditScrapers = RedditScraperCollection::collection($user->redditScrapers);
        
        return response()->json([
            'data' => $redditScrapers
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
            'subreddit' => 'required|string',
            'filter_by' => 'required|string',
            'time_filter' => 'required|string',
            'limit_posts' => 'required|int|max:100|min:1',
        ]);

        RedditScraper::create(
            [
                'subreddit' => $validated['subreddit'],
                'user_id' => auth()->user()->id,
                'filter_by' => $validated['filter_by'],
                'time_filter' => $validated['time_filter'],
                'limit' => $validated['limit_posts'],
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RedditScraper  $redditScraper
     * @return \Illuminate\Http\Response
     */
    public function show(RedditScraper $redditScraper)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RedditScraper  $redditScraper
     * @return \Illuminate\Http\Response
     */
    public function edit(RedditScraper $redditScraper)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RedditScraper  $redditScraper
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RedditScraper $redditScraper)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RedditScraper  $redditScraper
     * @return \Illuminate\Http\Response
     */
    public function destroy(RedditScraper $redditScraper)
    {
        //
    }
}
