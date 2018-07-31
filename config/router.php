<?php

$router = new \Bramus\Router\Router();

// Define routes
// ...


$router->post('/api/token', '\Ayep\Controller\TokenController@postAction');
$router->delete('/api/token', '\Ayep\Controller\TokenController@expireAction');


$router->post('/api/category', '\Ayep\Controller\CategoryController@postAction');
$router->delete('/api/category/(\d+)', '\Ayep\Controller\CategoryController@deleteAction');
$router->get('/api/category', '\Ayep\Controller\CategoryController@getAction');
$router->put('/api/category/(\d+)', '\Ayep\Controller\CategoryController@updateAction');


$router->post('/api/post', '\Ayep\Controller\PostController@postAction');
$router->put('/api/post/(\d+)', '\Ayep\Controller\PostController@putAction');
$router->delete('/api/post/(\d+)', '\Ayep\Controller\PostController@deleteAction');
$router->get('/api/post', '\Ayep\Controller\PostController@getAction');
$router->get('/api/post/(\d+)', '\Ayep\Controller\PostController@getAction');


$router->post('/api/post/(\d+)/publish', '\Ayep\Controller\PostController@publishAction');
$router->post('/api/post/(\d+)/unpublish', '\Ayep\Controller\PostController@unpublishAction');

$router->run();


