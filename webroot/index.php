<?php

require __DIR__.'/config_with_app.php'; 

$app->theme->configure(ANAX_APP_PATH . 'config/theme-corgi.php');

$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);
$app->theme->addStylesheet('css/form.css');

$di->set('CommentController', function() use ($di) {
    $controller = new Phpmvc\Comment\CommentController();
    $controller->setDI($di);
    return $controller;
});

$di->set('UsersController', function() use ($di) {
    $controller = new \Anax\Users\UsersController();
    $controller->setDI($di);
    return $controller;
});

$di->setShared('db', function() {
    $db = new \Mos\Database\CDatabaseBasic();
    $db->setOptions(require ANAX_APP_PATH . 'config/config_mysqlonline.php');
    $db->connect();
    return $db;
});
   
// Home route.
$app->router->add('', function() use ($app) { 
    $app->theme->setTitle("Hello Corgi");

    $app->dispatcher->forward([
        'controller' => 'comment',
        'action'     => 'latest',
    ]);    
    
    $app->dispatcher->forward([
        'controller' => 'users',
        'action'     => 'top-users',
    ]);        
    
    $app->dispatcher->forward([
        'controller' => 'comment',
        'action'     => 'top-category',
    ]);  
});

// Login router.
$app->router->add('login', function() use ($app) {   
    $app->theme->setTitle("Login");
 
    $app->dispatcher->forward([
        'controller' => 'users',
        'action'     => 'login',
    ]);    
    
});

// Tags router.
$app->router->add('categories', function() use ($app) {
    
    $app->theme->setTitle("Taggar");
 
    $app->dispatcher->forward([
        'controller' => 'comment',
        'action'     => 'category',
    ]);    
    
    $app->dispatcher->forward([
        'controller' => 'comment',
        'action'     => 'top-category',
    ]);  
});

// Comments route.
$app->router->add('questions', function() use ($app) { 
    $app->theme->setTitle("Frågor");
    $app->dispatcher->forward([
        'controller' => 'comment',
        'action'     => 'view'
    ]);
});

// Users route.
$app->router->add('users', function() use ($app) {
    $app->dispatcher->forward([
        'controller' => 'users',
        'action'     => 'all'
    ]);
    
    $app->dispatcher->forward([
        'controller' => 'users',
        'action'     => 'top-users',
    ]); 
});

// About route.
$app->router->add('about', function() use ($app) {       
    $app->theme->setTitle("Om oss");
    $content = $app->fileContent->get('omoss.md'); 
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown');
    $byline = $app->fileContent->get('ommig.md');
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown'); 
    $app->views->add('me/page', [
        'content' => $content,
    ]);  
    
    $app->views->add('me/page', [
        'content' => $byline,
    ]);  
});

$app->router->handle();
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_corgi.php');
$app->theme->render();
