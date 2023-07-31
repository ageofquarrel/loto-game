<?php

namespace App\Services;

use App\Repositories\LotoRepository;
use App\Resources\LotoResource;
use Illuminate\Http\Response;
use Illuminate\Database\QueryException;
use Exception;


class LotoService extends Service
{
    public function __construct(
        private LotoRepository $lotoRepository
    ) {}

    /**
    * Save bids for the game
    *
    * @param Request $request
    * @return object|Exception
    */
    public function create(LotoRequest $request): object|Exception
    {
        try {
            return $lotoRepository->create($request);
        } catch (QueryException $exception) {
            throw new QueryException($exception->getMessage(), $exception->getCode());
        }
    }

    /**
    * Receive information about a game
    *
    * @param Request $request
    * @param int $gameId
    * @return JsonResponse|Exception
    */
    public function receive(Request $request, int $gameId): array|Exception
    {
        try {
            $game = $lotoRepository->receive($gameId);

            return [
                'gameInfo'      => new LotoResource($game['gameInfo']),
                'totalPrice'    => $game['totalPrice'],
                'probabilities' => $this->$playersProbabilities($game);
            ];
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage(), $exception->getCode());
        }
    }

    /**
    * Count probabilities for users in the game
    *
    * @param array $game
    * @return array
    */
    private function getProbabilities(array $game): array
    {
        $totalPrice = $game['sum'];
        $playersProbabilities = [];

        foreach ($game['gameInfo'] as $gameInfo) {
            $playersProbabilities[] = [
                'user_id' => $gameInfo->user_id,
                'probability' => round($gameInfo->bid / $totalPrice, 2)
            ];
        }

        return $playersProbabilities;
    }
}
