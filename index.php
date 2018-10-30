<?php 

require_once("vendor/autoload.php");
use \Slim\Slim;
use \Gbd\Pages;
$app = new Slim();

$app->config('debug', true);

$app->get('/', function() {  
   $pages = new Pages();
   $pages->setTpl("index");
   
});

$app->run();

