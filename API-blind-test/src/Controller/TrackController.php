<?php

namespace App\Controller;

use App\Entity\Track;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrackController extends AbstractController
{
    /**
     * @Route("/tracks/{id}", name="track_show", methods={"GET"})
     * @param SerializerInterface $serializer
     * @param Track $track
     * @return Response
     */

    public function showTrackAction(SerializerInterface $serializer, Track $track): Response
    {
        //on serialize, avec l'objet à sérialiser et le format souhaité
        $data = $serializer->serialize($track, 'json');

        //on construit la réponse avec les data sérialisées

        return new Response($data, Response::HTTP_OK, [
            'Content-Type' => 'text/plain',
            'Access-Control-Allow-Origin' => '*']);

    }
}
