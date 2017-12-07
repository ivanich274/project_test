<?php
/**
 * Created by PhpStorm.
 * User: Лисица
 * Date: 07.12.2017
 * Time: 12:21
 */

namespace BlogBundle\Controller;


use BlogBundle\Entity\User;
use BlogBundle\Form\UserType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserController extends Controller
{


    public function signupAction(Request $request, UserPasswordEncoderInterface $passwordEncoder = null)
    {
        $user = new User();

        $form = $this->createForm('BlogBundle\Form\UserType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);


            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user_view');
        }


        return $this->render('/User/signup.html.twig', [
            'form' => $form->createView()
        ]);

    }

    public function CabinetAction(Request $request)
    {


        return new Response('OK');
    }


}