<?php
require_once __DIR__ . '/../vendor/autoload.php';


use Phpfastcache\Helper\Psr16Adapter;
use InstagramScraper\Instagram;
use GuzzleHttp\Client;


$instagram = Instagram::withCredentials(
    new Client(),
    'erickrochaamorim',
    '@erk#171',
    new Psr16Adapter('Files')
);

$instagram->login();

$account = $instagram->getAccountById(3);

echo $account->getUsername() . "\n";
