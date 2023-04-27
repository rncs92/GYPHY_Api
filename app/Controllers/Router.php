<?php

namespace Giphy\Controllers;
use Giphy\Model\GiphyApi;

class Router
{
    private GiphyApi $client;

    public function __construct()
    {
        $this->client = new GiphyApi();
    }
    public function trending(): array
    {
        return $this->client->showTrending();
    }
    public function search(): array
    {
        return $this->client->searchGif();
    }
}