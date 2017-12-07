<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\User;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class LoginController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authenticationUtils)
    {
        $user = new User();
        //AuthenticationUtils $authenticationUtils

        $form = $this->createForm('BlogBundle\Form\LoginType', $user);
        $form->handleRequest($request);


        return $this->render('/User/login.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
