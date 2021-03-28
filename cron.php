<?php

/*
 *  All rights reserved © 2020 Eptech.
 */

require_once 'vendor/autoload.php';

use Erik\ErikTMDBCron\UpdateTopRatedMovies;
use Laminas\ServiceManager\ServiceManager;
use Symfony\Component\Console\Application;


$config = require __DIR__ . '/config/config.php';
$dependencies = $config['dependencies'];
$dependencies['services']['config'] = $config;

$serviceManager = new ServiceManager($dependencies);
$app = new Application();
$topRatedMoviesService = $serviceManager->get(UpdateTopRatedMovies::class);
$app->add($topRatedMoviesService);
$app->run();
