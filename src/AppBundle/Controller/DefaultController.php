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
    public function showAction(Article $article)
    {
        return $this->render('default/show.html.twig', [
            'article' => $article
        ]);
    }


}
