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
     * @Route("/users", name="user_or_session_create", methods={"POST"})
     * @param Request $request
     * @param SerializerInterface $serializer
     * @return Response
     */
    public function createUserOrSessionAction(Request $request, SerializerInterface $serializer): Response
    {
        $requestData = $request->getContent();
        $user = $serializer->deserialize($requestData, User::class, 'json');
        $isAuthenticated = $this->checkSession();

        if ($isAuthenticated){
            return new Response('Vous êtes déjà connecté en tant que ' . $user->getUsername(), Response::HTTP_BAD_REQUEST);
        } else {
            if (preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
                return $this->createUserOrSession($user, $serializer);
            } else {
                return new Response('Mauvaise requête.', Response::HTTP_BAD_REQUEST);
            }
        }
    }

    /**
     * @Route("/users", name="user_logout", methods={"GET"})
     * @param UserRepository $userRepository
     * @return Response
     */
    public function logoutUserAction(UserRepository $userRepository) : Response
    {
        $isAuthenticated = $this->checkSession();

        preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches);
        $jwt = $matches[1];

        if ($isAuthenticated){
            $user = $userRepository->findOneBy(['sessionToken' => $jwt]);
            $user->setSessionToken(null);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return new Response('', Response::HTTP_OK, [
                'Access-Control-Allow-Origin' => '*'
            ]);
        } else {
            return new Response('Vous n\'êtes pas identifié.', Response::HTTP_BAD_REQUEST);
        }
    }

    private function createUserOrSession(User $user, SerializerInterface $serializer) : Response
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
        $responseData = $serializer->serialize($token, 'json');
        return new Response($responseData, Response::HTTP_CREATED, [
            'Content-Type' => 'application/json',
            'Access-Control-Allow-Origin' => '*'
        ]);
    }
}
