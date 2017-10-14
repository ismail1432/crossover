<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\{Route,ParamConverter};
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository(Article::class)->findLastTen();

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'articles' => $articles
        ]);
    }



    /**
     * @Route("/article/show/{id}", name="article_show", requirements={"page": "\d+"})
     * @ParamConverter("post", class="AppBundle:Article")
     */
    public function showAction(Article $article) :Response
    {
        return $this->render('default/show.html.twig', [
            'article' => $article
        ]);
    }


}
