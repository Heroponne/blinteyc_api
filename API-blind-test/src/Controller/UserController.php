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
    public function loginAction(Request $request, SerializerInterface $serializer): Response
    {
        $requestData = $request->getContent();
        $user = $serializer->deserialize($requestData, User::class, 'json');

        $currentUser = $this->checkSession($request);

        if ($currentUser){
            return new Response('Vous êtes déjà connecté en tant que ' . $currentUser->getUsername(), Response::HTTP_BAD_REQUEST);
        } else {
            return $this->createUserOrSession($user);
        }
    }

    /**
     * @Route("/users/logout", name="user_logout", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function logoutUserAction(Request $request) : Response
    {
        $currentUser = $this->checkSession($request);

        if ($currentUser){
            $currentUser->setSessionHash(null);
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

    private function createUserOrSession(User $user) : Response
    {
        $username = $user->getUsername();
        $em = $this->getDoctrine()->getManager();
        $dbUser = $em->getRepository(User::class)->findOneBy(['username' => $username]);

        //on vérifie si l'utilisateur est déjà en BDD
        //si non on le persiste
        //si oui on édite son token
        if (!$dbUser) {
            $user->setSessionHash(hash("sha1", $username, true));
            $em->persist($user);
        } else {
            $dbUser->setSessionHash(hash("sha1", $username, true));
        }

        $em->flush();
        return new Response(json_encode($username), Response::HTTP_CREATED, [
            'Content-Type' => 'application/json',
            'Access-Control-Allow-Origin' => '*'
        ]);
    }
}
