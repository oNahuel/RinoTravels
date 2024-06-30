<?php
//
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    '/rinotravel/' => 'controladores/HomeController.php',
];

routeToController($uri,$routes);

function routeToController($uri, $routes) : void{
    if(array_key_exists($uri,$routes)){
        require $routes[$uri];
    }
}