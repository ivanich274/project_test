<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\User;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request /*, AuthenticationUtils $authenticationUtils*/)
    {

        //Это альтернативная релизация, т.к AuthenticationUtils $authenticationUtils на входе метода = NULL.
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();


        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();


        $user = new User();
        //AuthenticationUtils $authenticationUtils

        $form = $this->createForm('BlogBundle\Form\LoginType', $user);
        $form->handleRequest($request);


        return $this->render('/User/login.html.twig', [
            'form' => $form->createView(),
            'error' => $error,
            'lastUsername' => $lastUsername
        ]);
    }

}
