<?php

namespace Giphy;

class GIF
{
    private string $url;

    public function __construct(string $url)
    {
    $this->url = $url;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}