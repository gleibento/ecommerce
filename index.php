<?php 

require_once("vendor/autoload.php");
use \Slim\Slim;
use \Gbd\Pages;
use Gbd\PageAdmin;
$app = new Slim();

$app->config('debug', true);

$app->get('/', function() {  
   $pages = new Pages();
   $pages->setTpl("index");
   
});
$app->get('/admin',function(){ 
    $pageAdmin = new PageAdmin();
     $pageAdmin->setTpl("index");
});
$app->run();

