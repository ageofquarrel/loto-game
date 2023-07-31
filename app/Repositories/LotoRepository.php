<?php

namespace App\Repositories;

use App\Services\Service;
use Exception;
use Illuminate\Http\Response;
use App\Models\Loto;

class LotoRepository
{
    /**
    * Save bids for the game
    *
    * @param Request $request
    * @return object|QueryException
    */
    public function create(LotoRequest $request): object|QueryException
    {
        try {
            return Loto::create[
                'user_id'       => $request->user_id,
                'session_id'    => $request->session_id,
                'bid'           => $request->bid 
            ];
        } catch (QueryException $exception) {
            throw new QueryException($exception->getMessage(), $exception->getCode());
        }
    }

    /**
    * Receive information about a game
    *
    * @param Request $request
    * @param int $gameId
    * @return array|QueryException
    */
    public function receive(Request $request, int $gameId): array|QueryException
    {
        try {
            return  [
                        'gameInfo'         => Loto::where('game_id', $gameId)->get(),
                        'totalPrice'       => Loto::where('game_id', $gameId)->sum('bid')
                    ];
        } catch (QueryException $exception) {
            throw new QueryException($exception->getMessage(), $exception->getCode());
        }
    }
}
