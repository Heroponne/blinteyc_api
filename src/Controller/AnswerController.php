<?php

namespace App\Controller;

use App\Repository\ParticipationRepository;
use App\Repository\TrackRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnswerController extends SessionController
{
    /**
     * @Route("/answers", name="answer_check", methods={"POST"})
     * @param TrackRepository $trackRepository
     * @param Request $request
     * @param ParticipationRepository $participationRepository
     * @return Response
     */
    public function checkAnswer(TrackRepository $trackRepository, Request $request, ParticipationRepository $participationRepository): Response
    {
        $currentUser = $this->checkSession($request);
        if ($currentUser) {
            $requestData = $request->toArray();
            //on récupère l'id de la chanson
            $track_id = $requestData['track_id'];
            //on récupère la réponse de l'utilisateur
            $answer = $requestData['answer'];

            //on récupère la chanson dans la BDD
            $track = $trackRepository->find(intval($track_id));

            if (mb_strtoupper($track->getArtist()) == mb_strtoupper($answer) || mb_strtoupper($track->getTitle()) == mb_strtoupper($answer)) {
                $participation = $participationRepository->find($requestData['participationToken']);
                $participation->setCurrentScore($participation->getCurrentScore() + (30 - intval($requestData['current_time'])));

                $em = $this->getDoctrine()->getManager();
                $em->persist($participation);
                $em->flush();

                $result = json_encode(["result" => "Bonne réponse ! Veuillez patienter pour la suite...", "score" => 30 - intval($requestData['current_time'])]);
            } else {
                $result = json_encode(["result" => "Loupé ! Réessayez autre chose :)"]);
            }
            return new Response($result, Response::HTTP_OK, [
                'Content-Type' => 'text/plain',
                'Access-Control-Allow-Origin' => '*']);
        } else {
            return new Response('Vous n\'êtes pas authentifié.', Response::HTTP_BAD_REQUEST);
        }
    }
}
