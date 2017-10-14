<?php
/**
 * Created by PhpStorm.
 * User: contact@smaine.me
 * Date: 14/10/2017
 * Time: 03:01
 */

namespace Tests\AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class MediaControllerTest extends WebTestCase
{
    public function testRssFeed()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/article/rss');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }
}