<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class SessionController extends AbstractController
{
    /**
     * return the current user if a valid session token is found in the request header
     * @param Request $request
     * @return User
     */
    public function checkSession(Request $request): ?User
    {
        $sessionToken = $request->headers->get('sessionToken');
        if ($sessionToken) {
            $em = $this->getDoctrine()->getManager();
            $dbUser = $em->getRepository(User::class)->findOneBy(['sessionHash' => pack("H*", $sessionToken)]);
            if ($dbUser) {
                return $dbUser;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
}
