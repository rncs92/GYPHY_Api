<?php

namespace Giphy\Controllers;

class Router
{
public function trending()
{
    require 'app/View/trending.php';
}
public function search()
{
    require 'app/View/search.php';
}
}