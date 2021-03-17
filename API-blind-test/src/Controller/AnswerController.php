<?php

namespace App\Controller;

use App\Entity\Track;
use App\Repository\TrackRepository;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnswerController extends AbstractController
{
    /**
     * @Route("/answers", name="answer_check", methods={"GET"})
     * @param TrackRepository $trackRepository
     * @return Response
     */
    public function checkAnswer(TrackRepository $trackRepository): Response
    {
        //on récupère l'id de la chanson
        $track_id = $_GET['track_id'];
        //on récupère la réponse de l'utilisateur
        $answer = $_GET['answer'];

        //on récupère la chanson dans la BDD
        $track = $trackRepository->find(intval($track_id));
        $result = (mb_strtoupper($track->getArtist()) == mb_strtoupper($answer) || mb_strtoupper($track->getTitle()) == mb_strtoupper($answer)) ? "Bonne réponse !" : "Loupé !";

        return new Response($result, Response::HTTP_OK, [
            'Content-Type' => 'text/plain',
            'Access-Control-Allow-Origin' => '*']);
    }
}
