<?php
/**
 * Created by PhpStorm.
 * User: Лисица
 * Date: 04.12.2017
 * Time: 14:12
 */

namespace BlogBundle\Controller;


use BlogBundle\Entity\Blog;
use BlogBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{


    public function homepageAction()
    {
        return $this->render("base.html.twig");

    }

    public function blogViewAction($id)
    {

        $em = $this->getDoctrine();

        $blogRepository = $em->getRepository("BlogBundle:Blog");
        $blog = $blogRepository->find($id);


        return $this->render("Blog/view.html.twig", [
            'blog' => $blog
        ]);
    }

    public function blogListAction(Request $request)
    {

        $em = $this->get('doctrine.orm.entity_manager');
        /**
         * Как я понял, для пагнации без конкретного sql запроса не обойтись.
         * Либо искать другой пагинатор, который просто расчитает количество страниц и передаст в метод.
         */
        $query = $em->createQuery("SELECT a FROM BlogBundle:Blog a");

        $paginator = $this->get('knp_paginator');

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            5
        );


        return $this->render("Blog/list.html.twig", [
            'blogs' => $pagination
        ]);


    }

    /**
     * Добавление продукта с категорией.
     */
    public function createAction(Request $request)
    {

        $Product = new Product();
        $form = $this->createForm('BlogBundle\Form\ProductForm', $Product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($Product);
            $em->flush();

        }


        return $this->render('Blog/createPost.html.twig', array(
            'form' => $form->createView(),
        ));

    }

    /**
     * Редактирование продукта с категорией.
     * @param $id
     * @param Request $request
     */
    public function editAction($id, Request $request) {



        $em = $this->getDoctrine();

        $postRepository = $em->getRepository("BlogBundle:Product");
        $post = $postRepository->find($id);

        $form = $this->createForm('BlogBundle\Form\ProductForm', $post);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('product_view', array('id' => $post->getId()));
        }


        return $this->render("Admin/edit.html.twig", [
            'form' => $form->createView()
        ]);


        return new Response($id);
    }


    public function viewAction($id)
    {

        $em = $this->getDoctrine();

        $blogRepository = $em->getRepository("BlogBundle:Product");
        $blog = $blogRepository->find($id);


        return $this->render("Blog/productView.html.twig", [
            'blog' => $blog
        ]);
    }



    public function createPostAction(Request $request)
    {

        $blog = new Blog();
        $form = $this->createForm('BlogBundle\Form\PostType', $blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($blog);
            $em->flush();

            return $this->redirectToRoute('blog_view', array('id' => $blog->getId()));
        }


        return $this->render('Blog/create.html.twig', array(
            'blog' => $blog,
            'form' => $form->createView(),
        ));


    }


}