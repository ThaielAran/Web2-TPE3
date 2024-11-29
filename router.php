<?php
require_once './api/config/config.php';
require_once './api/libs/router.api.php';
require_once './api/controllers/movie.api.controller.php';
require_once './api/controllers/review.api.controller.php';

$router = new Router();

// tabla de ruteo
$router->addRoute('movies',         'GET',      'MovieApiController',       'getMovies');
$router->addRoute('movies/:ID',     'GET',      'MovieApiController',       'getMovie');

// tabla de ruteo reviews
$router->addRoute('reviews',        'GET',      'ReviewApiController',      'getReviews');
$router->addRoute('reviews/:ID',    'GET',      'ReviewApiController',      'getReview');
$router->addRoute('reviews',        'POST',     'ReviewApiController',      'addReview');
$router->addRoute('reviews/:ID',    'PUT',      'ReviewApiController',      'editReview');
$router->addRoute('reviews/:ID',    'DELETE',   'ReviewApiController',      'deleteReview');

// ruta por defecto
$router->setDefaultRoute(                       'ApiController',            'error');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);