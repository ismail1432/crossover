<?php
/**
 * Created by PhpStorm.
 * User: contact@smaine.me
 * Date: 14/10/2017
 * Time: 01:54
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\{Route, ParamConverter};
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    /**
     * @Route("/admin/article/add", name="article_add")
     */
    public function addAction(Request $request)
    {

        $form = $this->createForm(ArticleType::class);
        $form->handleRequest($request);

        if($request->isMethod('POST') && $form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $article = $form->getData();
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $article->setReporter($user);
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
     * @Route("/admin/article/remove/{id}", name="article_remove", requirements={"page": "\d+"})
     * @ParamConverter("post", class="AppBundle:Article")
     */
    public function removeAction(Article $article)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.token_storage')->getToken()->getUser();
        if($user->getId() !== $article->getReporter()->getId()){
            $this->addFlash('notice', 'You are not allowed to do that !');

            return $this->redirectToRoute('homepage');
        }
        $em->remove($article);
        $em->flush();

        $this->addFlash('notice', 'Article removed !');

        return $this->redirectToRoute('article_list');
    }

    /**
     * @Route("/admin/article/list", name="article_list")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository(Article::class)->findArticleByUser();

        return $this->render('default/list.html.twig', [
            'articles' => $articles
        ]);
    }
}