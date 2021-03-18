<?php

namespace App\Controller;

use App\Entity\User;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/users/{id}", name="user_show", methods={"GET"})
     * @param SerializerInterface $serializer
     * @param User $user
     * @return Response
     */
    public function showUserAction(SerializerInterface $serializer, User $user): Response
    {
        $data = $serializer->serialize($user, 'json');
        return new Response($data, Response::HTTP_OK, [
            'Content-Type' => 'application/json',
            'Access-Control-Allow-Origin' => "*"
        ]);
    }

    /**
     * @Route("/users", name="user_create", methods={"POST"})
     * @param Request $request
     * @param SerializerInterface $serializer
     * @return Response
     */
    public function createUserAction(Request $request, SerializerInterface $serializer): Response
    {
        $data = $request->getContent();
        $user = $serializer->deserialize($data, User::class, 'json');

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        try {
            $em->flush();
            return new Response('', Response::HTTP_CREATED);
        } catch (\Exception $e){
            return new Response("Erreur d'enregistrement, ce pseudo est déjà pris !", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
