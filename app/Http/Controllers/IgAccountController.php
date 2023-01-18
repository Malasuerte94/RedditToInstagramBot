<?php

namespace App\Http\Controllers;

use App\Models\IgAccount;
use App\Models\Log;
use App\Models\User;
use App\Services\Instagram\InstagramService;
use App\Services\LogService;
use Illuminate\Http\Request;

class IgAccountController extends Controller
{
    private InstagramService $instagramService;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $user = auth()->user();
        $igAccounts = $user->igAccounts;

        return response()->json(
            [
                'data' => $igAccounts,
            ],
            200
        );
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
        $accountIdAndUsername = $this->instagramService->getAccountId();
        $igBusinessAccountId = $this->instagramService->getIgBusinessAccountId($accountIdAndUsername['id']);

        if ($igAccounts->isEmpty() || $igAccounts->where('business_id', $igBusinessAccountId)->isEmpty()) {
            if ($igBusinessAccountId === null || $accountIdAndUsername['id'] === null) {
                LogService::log([
                    'type' => Log::TYPE_ERROR,
                    'model' => IgAccountController::class,
                    'message' => 'Instagram business account not found',
                ]);
                return response()->json(
                    [
                        'message' => 'Instagram business account not found',
                    ],
                    400
                );
            }

            $igAccount = new IgAccount();
            $igAccount->username = $accountIdAndUsername['username'];
            $igAccount->account_id = $accountIdAndUsername['id'];
            $igAccount->business_id = $igBusinessAccountId;
            $igAccount->user_id = $user->id;
            $igAccount->save();

            LogService::log([
                'type' => Log::TYPE_SUCCESS,
                'model' => IgAccount::class,
                'model_id' => $igAccount->id,
                'message' => 'Instagram account created successfully',
                'data' => json_encode($igAccount->username),
            ]);

            return response()->json(
                [
                    'message' => 'Account created successfully',
                ],
                200
            );
        }

        LogService::log([
            'type' => Log::TYPE_WARNING,
            'model' => IgAccountController::class,
            'message' => 'Account already exists',
            'data' => json_encode($igBusinessAccountId),
        ]);

        return response()->json(
            [
                'message' => 'Account already exists',
            ],
            200
        );
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
