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
     * @Route("/games/create", name="game_create", methods={"POST"})
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
     * @Route("/games/play", name="game_start", methods={"POST"})
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
                if ($game->getState() === $stateRepository->find(2)){
                    $nbTracks = $game->getPlaylist()->getTracks()->count();
                    if ($game->getCurrentTrack() < $nbTracks){
                        $track = $game->getPlaylist()->getTracks()->get($game->getCurrentTrack());
                        $responseArray = ['track_url' => $track->getTrackUrl(), 'track_id' => $track->getId()];
                        $game->setCurrentTrack($game->getCurrentTrack() + 1);
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($game);
                        $em->flush();
                        return new Response(json_encode($responseArray), Response::HTTP_OK);
                    } else {
                        $response = ['ended' => 'Partie terminée'];
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

    /**
     * @Route("/game_play", name="game", methods={"GET"})
     * @param ParticipationRepository $participationRepository
     * @param Request $request
     * @return Response
     */
    public function playGameAction(ParticipationRepository $participationRepository, Request $request) : Response
    {
        $currentUser = $this->checkSession($request);
        if ($currentUser){
            $requestData = $request->getContent();
            $participationId = $requestData['participationToken'];
            if ($participationId){
                $game = $participationRepository->find($participationId)->getGame();
                $startTime = $game->getStartTime();
                $currentTrack = $game->getCurrentTrack();
                $nbTracks = $game->getPlaylist()->getTracks()->count();
                //on vérifie qu'il y a toujours des chansons disponibles
                if ($currentTrack <= $nbTracks){
                    //on vérifie les temps :
                    //si on a dépassé
                    if (new \DateTime() >= $startTime->add(new \DateInterval('T20S'))){
                        $game->setCurrentTrack($currentTrack + 1);
                        $game->setStartTime(new \DateTimeImmutable());
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($game);
                        $em->flush();
                        $newTrack = $game->getPlaylist()->getTracks()->get($currentTrack - 1)->getTrackURL();
                        $responseArray = ['track_url' => $newTrack->getTrackUrl(), 'track_id' => $newTrack->getId()];
                        return new Response(json_encode($responseArray), Response::HTTP_OK);
                    } else {
                        return new Response('Pas encore !', Response::HTTP_OK);
                    }
                } else {
                    return new Response('Partie finie !', Response::HTTP_OK);
                }
            } else {
                return new Response('Vous n\'avez pas de partie en cours.', Response::HTTP_BAD_REQUEST);
            }
        } else {
            return new Response('Vous n\'êtes pas authentifié.', Response::HTTP_BAD_REQUEST);
        }
    }
}
