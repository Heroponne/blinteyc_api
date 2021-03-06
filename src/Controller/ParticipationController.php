<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Participation;
use App\Repository\GameRepository;
use App\Repository\StateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParticipationController extends AbstractController
{
    /**
     * @Route("/participations", methods={"POST"})
     * @param $player
     * @param $game
     * @return Response
     */
    public function createParticipationAction($player, $game): Response
    {
        $participation = new Participation();
        $participation->setGame($game);
        $participation->setPlayer($player);
        $participation->setPlayerState(false);
        $em = $this->getDoctrine()->getManager();
        $em->persist($participation);
        $em->flush();

        $response = ['participation_id' => $participation->getId()];

        return new Response(json_encode($response), Response::HTTP_CREATED);
    }

    /**
     * @Route("/participations/{id}/get_ready", name="participation_create", methods={"POST"})
     * @param Participation $participation
     * @param StateRepository $stateRepository
     * @return Response
     */
    public function setReadyPlayerStateAction(Participation $participation, StateRepository $stateRepository): Response
    {
        $participation->setPlayerState(true);
        $players = $participation->getGame()->getParticipations();
        $readyPlayers = $players->filter(function ($element){
            return $element->getPlayerState() == 1;
        });
        $nbPlayers = $players->count();
        $nbReadyPlayers = $readyPlayers->count();

        if ($nbPlayers == $nbReadyPlayers && $participation->getGame()->getState() != $stateRepository->find(3)){
            $participation->getGame()->setState($stateRepository->find(2));
            $participation->getGame()->setStartTime(new \DateTimeImmutable());
            $participation->getGame()->setCurrentTrack(0);
        };

        $em = $this->getDoctrine()->getManager();
        $em->flush();
        return new Response('Pr??t !', Response::HTTP_OK);
    }
}
