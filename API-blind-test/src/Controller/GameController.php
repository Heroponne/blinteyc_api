<?php

namespace App\Controller;

use App\Entity\Game;
use App\Repository\GameRepository;
use App\Repository\PlaylistRepository;
use App\Repository\StateRepository;
use Firebase\JWT\JWT;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends SessionController
{
    /**
     * @Route("/game_create", name="game", methods={"POST"})
     * @param StateRepository $stateRepository
     * @param PlaylistRepository $playlistRepository
     * @param Request $request
     * @return Response
     */
    public function createGame(StateRepository $stateRepository, PlaylistRepository $playlistRepository, Request $request): Response
    {
        $currentUser = $this->checkSession($request);
        if ($currentUser){

            //création d'une partie
            $game = new Game();

            $state = $stateRepository->find(1);
            $game->setState($state);

            $playlist = $playlistRepository->find(1);
            $game->setPlaylist($playlist);

            $em = $this->getDoctrine()->getManager();
            $em->persist($game);
            $em->flush();

            return $this->forward('App\Controller\ParticipationController::createParticipationAction', [
                'player' => $currentUser,
                'game' => $game
            ]);
        } else {
            return new Response('Vous n\'êtes pas authentifié.', Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Route("/game_play", name="game", methods={"GET"})
     * @param GameRepository $gameRepository
     * @param Request $request
     * @return Response
     */
    public function playGameAction(GameRepository $gameRepository, Request $request) : Response
    {
        $currentUser = $this->checkSession($request);
        if ($currentUser){

        } else {

        }
        return new Response();
    }
}
