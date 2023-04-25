<?php

require 'vendor/autoload.php';
use Giphy\GiphyApi;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$client = new GiphyApi();
$search = $_GET['search'] ?? '';
$limit = $_GET['amount'] ?? 4;
$gif = $client->searchGif($search, $limit);
