<?php

namespace Tests\OC\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HTTPFoundation\Response;

class WelcomeControllerTest extends WebTestCase
{
    
    public function testHomepageIsUp()
    {
        $client = static::createClient();
        
        $client->request('GET', '/fr/');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        
        $client->request('GET', '/en/');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testHomepage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/fr/');
        $this->assertSame(1, $crawler->filter('html:contains("16 €")')->count());


        $crawler = $client->request('GET', '/en/');
        $this->assertSame(1, $crawler->filter('html:contains("16 €")')->count());
    }

}