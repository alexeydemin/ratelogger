<?php namespace tinkoff;

use Goutte\Client;
use Illuminate\Database\Eloquent\Model;

class Parser extends Model{

    public function parse_old() {
        $client = new Client();
        $client->getClient()->setDefaultOption('config/curl/'.CURLOPT_TIMEOUT, 60);

        $crawler = $client->request('GET', 'http://www.symfony.com/blog/');
        $link = $crawler->selectLink('Security Advisories')->link();
        $crawler = $client->click($link);
        $crawler->filter('h2 > a')->each(function ($node) {
            print '<li>' . $node->text() . '<br>';
        });
    }

    public function parse() {
        // JSON string
        // https://www.tinkoff.ru/api/v1/currency_rates/
        $client = new Client();
        $client->getClient()->setDefaultOption('config/curl/'.CURLOPT_TIMEOUT, 60);

        $crawler = $client->request('GET', 'http://www.symfony.com/blog/');
        $link = $crawler->selectLink('Security Advisories')->link();
        $crawler = $client->click($link);
        $crawler->filter('h2 > a')->each(function ($node) {
            print '<li>' . $node->text() . '<br>';
        });
    }

}