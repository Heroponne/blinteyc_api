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
     * @return Response
     */
    public function createGame(StateRepository $stateRepository, PlaylistRepository $playlistRepository): Response
    {
        $currentUser = $this->checkSession();
        if ($currentUser){

            //création d'une partie
            $game = new Game();

            //génération du Json Web Token (JWT)
            $secretKey = $this->getParameter('app.jwt_secret');
            $serverName = "http://localhost/appli-blind-test/API-blind-test";
            $date = new \DateTime();
            $data = [
                'iss' => $serverName,
                'iat' => $date->format('Y-m-d H:i:s')
            ];

            $token = JWT::encode(
                $data,
                $secretKey,
                'HS256'
            );

            $game->setToken($token);

            $state = $stateRepository->find(1);
            $game->setState($state);

            $playlist = $playlistRepository->find(1);
            $game->setPlaylist($playlist);

            $game->addPlayer($currentUser);

            $currentUser->setGameToken($token);

            $em = $this->getDoctrine()->getManager();
            $em->persist($game);
            $em->flush();

            return new Response(json_encode($token), Response::HTTP_CREATED);
        } else {
            return new Response('Vous n\'êtes pas authentifié.', Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param GameRepository $gameRepository
     * @return Response
     */
    public function startGame(GameRepository $gameRepository) : Response
    {
        $currentUser = $this->checkSession();
        if ($currentUser){
            // on vérifie qu'il ait un token de jeu
            // et que le token est valide (jeu existant et non terminé)
            $gameToken = $currentUser->getGameToken();
            if ($gameToken){
                $currentGame = $gameRepository;
            }
        }
    }
}
