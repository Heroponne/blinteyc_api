<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Firebase\JWT\JWT;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends SessionController
{
    /**
     * @Route("/user/{id}", name="user_show", methods={"GET"})
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
     * @Route("/users/login", name="user_or_session_create", methods={"POST"})
     * @param Request $request
     * @param SerializerInterface $serializer
     * @return Response
     */
    public function createUserOrSessionAction(Request $request, SerializerInterface $serializer): Response
    {
        $requestData = $request->getContent();
        $user = $serializer->deserialize($requestData, User::class, 'json');

        $currentUser = $this->checkSession();

        if ($currentUser){
            return new Response('Vous êtes déjà connecté en tant que ' . $currentUser->getUsername(), Response::HTTP_BAD_REQUEST);
        } else {
            if (preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
                return $this->createUserOrSession($user);
            } else {
                return new Response('Mauvaise requête.', Response::HTTP_BAD_REQUEST);
            }
        }
    }

    /**
     * @Route("/users/logout", name="user_logout", methods={"POST"})
     * @return Response
     */
    public function logoutUserAction() : Response
    {
        $currentUser = $this->checkSession();

        if ($currentUser){
            $currentUser->setSessionToken(null);
            $em = $this->getDoctrine()->getManager();
            $em->persist($currentUser);
            $em->flush();
            return new Response('', Response::HTTP_OK, [
                'Access-Control-Allow-Origin' => '*'
            ]);
        } else {
            return new Response('Vous n\'êtes pas identifié.', Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * @Route("/users/get_ready", name="user_ready", methods={"POST"})
     * @return Response
     */
    public function getReady() : Response
    {
        $currentUser = $this->checkSession();

        if ($currentUser){
            $currentUser->setReady(true);
            $em = $this->getDoctrine()->getManager();
            $em->persist($currentUser);
            $em->flush();
            return new Response('Vous êtes prêt à jouer !', Response::HTTP_OK, [
                'Access-Control-Allow-Origin' => '*'
            ]);
        } else {
            return new Response('Vous n\'êtes pas identifié.', Response::HTTP_UNAUTHORIZED);
        }
    }

    private function createUserOrSession(User $user) : Response
    {
        //génération du Json Web Token (JWT)
        $secretKey = $this->getParameter('app.jwt_secret');
        $serverName = "http://localhost/appli-blind-test/API-blind-test";
        $username = $user->getUsername();
        $date = new \DateTime();
        $data = [
            'iss' => $serverName,
            'username' => $username,
            'iat' => $date->format('Y-m-d H:i:s')
        ];

        $token = JWT::encode(
            $data,
            $secretKey,
            'HS256'
        );

        $em = $this->getDoctrine()->getManager();
        $dbUser = $em->getRepository(User::class)->findOneBy(['username' => $username]);

        //on vérifie si l'utilisateur est déjà en BDD
        //si non on le persiste
        //si oui on édite son token
        if (!$dbUser) {
            $user->setSessionToken($token);
            $em->persist($user);
        } else {
            $dbUser->setSessionToken($token);
        }

        $em->flush();
        return new Response(json_encode($token), Response::HTTP_CREATED, [
            'Content-Type' => 'application/json',
            'Access-Control-Allow-Origin' => '*'
        ]);
    }
}
