<?php
/**
 * Created by PhpStorm.
 * User: Лисица
 * Date: 05.12.2017
 * Time: 11:06
 */

namespace BlogBundle\Controller;


use BlogBundle\Form\Models\TaskModel;
use BlogBundle\Form\TaskForm;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class AdminController extends Controller
{

    public function indexAction(Request $request)
    {

        /*
        //Примеры формы без модели.
        $TaskForm = $this->createForm('BlogBundle\Form\TaskForm');
        $TaskForm->handleRequest($request);

        if ($TaskForm->isSubmitted() && $TaskForm->isValid()) {
            $task = $TaskForm->getData();

            var_dump($task);
        }
        */


        $TaskModel = new TaskModel();
        $TaskForm = $this->createForm('BlogBundle\Form\TaskForm', $TaskModel);
        $TaskForm->handleRequest($request);


        if ($TaskForm->isSubmitted() && $TaskForm->isValid()) {

            var_dump($TaskModel);
        }


        return $this->render("/Admin/index.html.twig", [
                'form' => $TaskForm->createView()
            ]
        );
    }

    public function listAction(Request $request)
    {

        $blog = $this->getDoctrine()->getRepository("BlogBundle:Blog");

        $page = $request->get('page') && $request->get('page') > 1 ? $request->get('page'): 1;
        $maxResult = 2;


        $blogs = $blog->findBlog(['page' => $page, 'maxResult' => $maxResult]);
        $countPost = $blog->findAllBlogCount();

        $pages = [
            'total' => array_shift($countPost),
            'page' => $page,
            'maxResult' => $maxResult,
            'url' => 'admin_blogs'
        ];


        return $this->render("/Admin/list.html.twig", [
                'blogs' => $blogs,
                'pagination' => $pages
            ]
        );
    }

    public function editAction($id, Request $request)
    {

        $em = $this->getDoctrine();
        $blogRepository = $em->getRepository("BlogBundle:Blog");
        $blog = $blogRepository->find($id);

        $TaskForm = $this->createForm('BlogBundle\Form\PostType', $blog);
        $TaskForm->handleRequest($request);


        if ($TaskForm->isSubmitted() && $TaskForm->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($blog);
            $em->flush();


            return $this->redirectToRoute('blog_view', array('id' => $blog->getId()));
        }






        return $this->render("/Admin/edit.html.twig", [
                'blog' => $blog,
                'form' => $TaskForm->createView()
            ]
        );


    }


}
