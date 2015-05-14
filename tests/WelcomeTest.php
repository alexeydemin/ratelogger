<?php
use Goutte\Client;
class WelcomeTest extends TestCase {

    public function testUserSeesWelcomeMessage()
    {
        $client = new Client();
        $crawler = $client->request('GET', 'http://tinkoff');
        $this->assertEquals(200, $client->getResponse()->getStatus());
        $this->assertCount(1,$crawler->filter('h1:contains("Welcome to Tinkoff")'));
    }
}