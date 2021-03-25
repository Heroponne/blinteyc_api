<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{
    /**
     * return true if a valid session token is found in a request header
     * @return bool
     */
    public function checkSession() : bool
    {
        //on vérifie si le client a déjà un token
        if (preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
            $jwt = $matches[1];
            if ($jwt) {
                $em = $this->getDoctrine()->getManager();
                $dbUser = $em->getRepository(User::class)->findOneBy(['sessionToken' => $jwt]);
                if ($dbUser) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
