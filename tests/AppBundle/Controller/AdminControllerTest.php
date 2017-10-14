<?php
/**
 * Created by PhpStorm.
 * User: contact@smaine.me
 * Date: 14/10/2017
 * Time: 02:33
 */

namespace Tests\AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Bundle\FrameworkBundle\Client;


class AdminControllerTest extends WebTestCase
{
    public function testSecuredAccess()
    {
        $client = static::createClient();
        $client->getCookieJar()->set(new Cookie(session_name(), true));

        $crawler = $client->request('GET', '/');

        $em = $client->getContainer()->get('doctrine')->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneByUsername('smaine');

        $token = new UsernamePasswordToken($user, $user->getPassword(), 'main', $user->getRoles());
        self::$kernel->getContainer()->get('security.token_storage')->setToken($token);

        $session = $client->getContainer()->get('session');
        $session->set('_security_' . 'main', serialize($token));
        $session->save();

        $routes = [
            '/admin/article/list',
            '/admin/article/add',
        ];
        foreach ($routes as $route){
            $crawler = $client->request('GET', $route);
            $this->assertEquals(200, $client->getResponse()->getStatusCode());
        }
    }

    public function testSecuredAccessRedirect()
    {
        $client = static::createClient();
        $routes = [
            '/admin/article/list',
            '/admin/article/add',
        ];
        foreach ($routes as $route){
            $crawler = $client->request('GET', $route);
            $this->assertEquals(302, $client->getResponse()->getStatusCode());
        }
    }
}