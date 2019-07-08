<?php

// src/Controller/SecurityController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;



class SecurityController extends AbstractController
{


    /**
     * @Route("/login" , name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
      
      /** 
       * config/packages/security.yaml
       * providers:
      *  from_database:
       *         entity:
       *             class: App\Entity\User
       *             property: username # 这里username对应getLastUsername()
       * 
      */
        
        $lastusername = $authenticationUtils->getLastUsername();
        $error = $authenticationUtils->getLastAuthenticationError();

         
        return $this->render(
            'security/login.html.twig',
            [
                'last_username' => $lastusername,
                'error' => $error,
            ]
        );
    }
}
