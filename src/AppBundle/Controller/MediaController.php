<?php
/**
 * Created by PhpStorm.
 * User: contact@smaine.me
 * Date: 14/10/2017
 * Time: 00:31
 */

namespace AppBundle\Controller;


use AppBundle\AppBundle;
use AppBundle\Entity\Article;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;


class MediaController extends Controller
{

    /**
     *
     * @Route("/article_pdf/{id}", name="article_pdf",requirements={"page": "\d+"})
     * @ParamConverter("post", class="AppBundle:Article")
     */
    public function pdfAction(Article $article)
    {

        $html = $this->renderView('pdf/show_pdf.html.twig', array(
            'article'  => $article
        ));

        $fileName = $article->getTitle().'_'.$article->getId().'.pdf';

        return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            $fileName
        );
    }

    /**
     *
     * @Route("/article_rss", name="article_rss")
     */
    public function feedAction()
    {
        $articles = $this->getDoctrine()->getRepository(Article::class)->findLastTen();

        $feed = $this->get('eko_feed.feed.manager')->get('article');
        $feed->addFromArray($articles);

        return new Response($feed->render('rss'));
    }
}