<?php
/**
 * Created by PhpStorm.
 * User: contact@smaine.me
 * Date: 14/10/2017
 * Time: 00:31
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Article;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;



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
            'test.pdf'
        );
    }
}