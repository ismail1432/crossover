<?php

/**
 * Created by PhpStorm.
 * User: contact@smaine.me
 * Date: 14/10/2017
 * Time: 09:48
 */

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ArticleRepositoryTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        self::bootKernel();

        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testFindById()
    {
        $article = $this->em
            ->getRepository(\AppBundle\Entity\Article::class)
            ->findBy(['id' => 1])
        ;

        $this->assertCount(1, $article);
    }

    public function testFindLastTen()
    {
        $articles = $this->em
            ->getRepository(\AppBundle\Entity\Article::class)
            ->findLastTen()
        ;

        $this->assertCount(10, $articles);
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->em->close();
        $this->em = null; // avoid memory leaks
    }
}