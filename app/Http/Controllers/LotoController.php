<?php

namespace App\Http\Controllers;

use App\Controllers\Controller;
use App\Services\LotoService;
use App\Requests\LotoRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use Illuminate\Database\QueryException;

class LotoController exetends Controller
{
    public function __construct(
        private LotoService $lotoService
    ) {}


    /**
    * Save bids for the game
    *
    * @param LotoRequest $request
    */
    public function create(LotoRequest $request): JsonResponse|Exception
    {
        try {
            $result = $lotoService->create($request);

            return response()->json([
                'success'   => true,
                'data'      => [],
                'message'   => 'Bid for user ' . $request->user_id . ' for game ' . $request->game_id . ' was created'
            ]);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage(), $exception->getCode());
        }
    }

    /**
    * Receive information about a game
    *
    * @param Request $request
    * @param int $gameId
    * @return JsonResponse
    */
    public function receive(Request $request, int $gameId): JsonResponse
    {
        try {
            $result = $lotoService->receive($request, $gameId);

            return response()->json([
                'success'   => true,
                'data'      => $result,
                'message'   => ''
            ]);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage(), $exception->getCode());
        }
    }
}