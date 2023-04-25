<?php

namespace Giphy;
use GuzzleHttp\Client;
class GiphyApi
{
    private Client $client;
    private string $apiKey;
    private const API_URL = 'https://api.giphy.com/v1/gifs/search';
    private const TRENDING_URL = 'api.giphy.com/v1/gifs/trending';

    public function __construct()
    {
    $this->client = new Client();
    $this->apiKey = $_ENV['API_KEY'];
    }

    public function searchGif(string $search, int $limit): array
    {
        $response = $this->client->request('GET', self::API_URL, [
            'query' => [
                'api_key' => $this->apiKey,
                'q' => $search,
                'limit' => $limit,
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        $gifCollection = [];
        foreach($data['data'] as $gif) {
            $gifCollection[] = $this->createGif($gif);
        }
        return $gifCollection;
    }

    public function showTrending(): array
    {
        $response = $this->client->request('GET', self::TRENDING_URL, [
            'query' => [
                'api_key' => $this->apiKey,
                'limit' => 10,
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        $gifCollection = [];
        foreach($data['data'] as $gif) {
            $gifCollection[] = $this->createGif($gif);
        }
        return $gifCollection;
    }

    private function createGif($gif): GIF
    {
        return new GIF(
            $gif['images']['fixed_height']['url']
        );
    }
}
