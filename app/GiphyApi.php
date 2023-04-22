<?php

namespace Giphy;
use GuzzleHttp\Client;
class GiphyApi
{
    private Client $client;

    public function __construct()
    {

    $this->client = new Client();
    }

    public function fetch()
    {

    }
}