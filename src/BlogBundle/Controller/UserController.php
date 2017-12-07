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

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;


class UserController extends Controller
{

    public function signupAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm('BlogBundle\Form\UserType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $password = $encoder->encodePassword($user->getPlainPassword(), $user->getSalt());

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