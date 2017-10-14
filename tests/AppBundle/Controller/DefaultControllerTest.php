<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Welcome in da Cross Application', $crawler->filter('h2')->text());
    }

    public function testRoutes()
    {
        $client = static::createClient();

        $routes = [
            '/',
            'article/show/1',
        ];
        foreach ($routes as $route){
            $crawler = $client->request('GET', $route);
            $this->assertEquals(200, $client->getResponse()->getStatusCode());
        }

    }

    public function testRoutesError()
    {
        $client = static::createClient();

        //Return a 404 because there is not entity Article with id 100
        $routes = [
            'article/show/100',
        ];
        foreach ($routes as $route){
            $crawler = $client->request('GET', $route);
            $this->assertEquals(404, $client->getResponse()->getStatusCode());
        }

    }

}
