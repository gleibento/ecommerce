<?php

session_start();
require_once("vendor/autoload.php");

use \Slim\Slim;
use \Gbd\Pages;
use Gbd\PageAdmin;
use Gbd\Model\User;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function() {
    
    $pages = new Pages();
    $pages->setTpl("index");
});
$app->get('/admin', function() {
    User::verifyLogin();
    $pageAdmin = new PageAdmin();
    $pageAdmin->setTpl("index");
});
$app->get('/admin/login', function () {
    $page = new PageAdmin([
        "header" => FALSE,
        "footer" => FALSE
    ]);
    $page->setTpl("login");
});
$app->post('/admin/login', function () {
    User::login($_POST["login"], $_POST["password"]);
    header("Location:/admin");
    exit;
});
$app->get('/admin/logout', function () {
    User::logout();
    header("Location:/admin/login");
    exit();
});

$app->run();

