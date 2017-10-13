<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/article/add", name="article_add")
     */
    public function addAction(Request $request)
    {

        $form = $this->createForm(ArticleType::class);

        $form->handleRequest($request);

        if($request->isMethod('POST') && $form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $article = $form->getData();

            $em->persist($article);
            $em->flush($article);

            $this->addFlash('notice', 'Article added successfully');

            return $this->redirectToRoute('article_show',['id'=> $article->getId()]);

        }
        return $this->render('default/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/article/show/{id}", name="article_show", requirements={"page": "\d+"})
     * @ParamConverter("post", class="AppBundle:Article")
     */
    public function showAction(Article $article)
    {
        return $this->render('default/show.html.twig', [
            'article' => $article
        ]);
    }

    /**
     * @Route("/article/remove/{id}", name="article_remove", requirements={"page": "\d+"})
     * @ParamConverter("post", class="AppBundle:Article")
     */
    public function removeAction(Article $article)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($article);
        $em->flush();

        $this->addFlash('notice', 'Article removed !');

        return $this->redirectToRoute('article_list');
    }

    /**
     * @Route("/article/list", name="article_list")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository(Article::class)->findLastTen();

        $this->addFlash('notice', 'Article removed !');

        return $this->render('default/list.html.twig', [
            'articles' => $articles
        ]);
    }


}
