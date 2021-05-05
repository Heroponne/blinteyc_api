<?php

namespace App\Controller;

use App\Entity\Game;
use App\Repository\ParticipationRepository;
use App\Repository\PlaylistRepository;
use App\Repository\StateRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends SessionController
{
    /**
     * @Route("/games", methods={"POST"})
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
     * @Route("/games/play", methods={"POST"})
     * @param StateRepository $stateRepository
     * @param ParticipationRepository $participationRepository
     * @param Request $request
     * @return Response
     */
    public function playGame(StateRepository $stateRepository, ParticipationRepository $participationRepository,Request $request) : Response
    {
        $currentUser = $this->checkSession($request);
        if ($currentUser) {
            $requestData = $request->toArray();
            $participationId = $requestData['participationToken'];
            if ($participationId) {
                $game = $participationRepository->find($participationId)->getGame();
                $participation = $participationRepository->find($participationId);
                if ($game->getState() === $stateRepository->find(2)){
                    $nbTracks = $game->getPlaylist()->getTracks()->count();
                    if ($game->getCurrentTrack() < $nbTracks){
                        $track = $game->getPlaylist()->getTracks()->get($game->getCurrentTrack());
                        $responseArray = ['track_url' => $track->getTrackUrl(), 'track_id' => $track->getId()];
                        //rajouter une restriction de temps pour les parties en multijoueur
                        //et éviter qu'à chaque requête d'utilisateur le currentTrack s'incrémente
                        //ou un trigger en base de données
                        $game->setCurrentTrack($game->getCurrentTrack() + 1);
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($game);
                        $em->flush();
                        return new Response(json_encode($responseArray), Response::HTTP_OK);
                    } else {
                        $totalScore = $participation->getCurrentScore();
                        $response = ['ended' => 'Partie terminée', 'score' => $totalScore];
                        $currentUser->setTotalScore($currentUser->getTotalScore() + $totalScore);

                        $game->setState($stateRepository->find(3));

                        $em = $this->getDoctrine()->getManager();
                        $em->persist($currentUser);
                        $em->persist($game);
                        $em->flush();

                        return new Response(json_encode($response), Response::HTTP_OK);
                    }
                } else{
                    return new Response('Pas encore !', Response::HTTP_FORBIDDEN);
                }
            } else {
                return new Response('Pas de partie en cours.', Response::HTTP_BAD_REQUEST);
            }
        } else {
            return new Response('Vous n\'êtes pas authentifié.', Response::HTTP_BAD_REQUEST);
        }
    }
}
