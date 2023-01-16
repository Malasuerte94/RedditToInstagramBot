<?php

namespace App\Http\Controllers;

use App\Models\IgAccount;
use App\Models\User;
use App\Services\Instagram\InstagramService;
use Illuminate\Http\Request;

class IgAccountController extends Controller
{

    public function __construct(protected readonly InstagramService $instagramService)
    {
           
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $user = auth()->user();
        $igAccounts = $user->igAccounts;

        return response()->json([
            'data' => $igAccounts
        ], 200);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): \Illuminate\Http\JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $igAccounts = $user->igAccounts;

        if($igAccounts->isEmpty()) {

            $accountIdAndUsername = $this->instagramService->getAccountId();
            $igBusinessAccountId = $this->instagramService->getIgBusinessAccountId($accountIdAndUsername['id']);

            if($igBusinessAccountId === null || $accountIdAndUsername['id'] === null) {
                return response()->json([
                    'message' => 'Instagram business account not found'
                ], 400);
            }
           
            $igAccount = new IgAccount();
            $igAccount->username = $accountIdAndUsername['username'];
            $igAccount->account_id = $accountIdAndUsername['id'];
            $igAccount->business_id = $igBusinessAccountId;
            $igAccount->user_id = $user->id;
            $igAccount->save();
            return response()->json([
                'message' => 'Account created successfully'
            ], 200);
        }

        return response()->json([
            'message' => 'Account already exists'
        ], 200);

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
     * @param  \App\Models\IgAccount  $igAccount
     * @return \Illuminate\Http\Response
     */
    public function show(IgAccount $igAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IgAccount  $igAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(IgAccount $igAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IgAccount  $igAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IgAccount $igAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IgAccount  $igAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(IgAccount $igAccount)
    {
        //
    }
}
