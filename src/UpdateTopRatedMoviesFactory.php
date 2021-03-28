<?php

/*
 *  All rights reserved © 2020 Eptech.
 */

declare(strict_types=1);

namespace Erik\ErikTMDBCron;

use Erik\ErikTMDBClient\TMDBApiService;
use Psr\Container\ContainerInterface;

/**
 * Description of UpdateTopRatedMoviesFactory
 *
 * @author Polácsek Erik<erikpolachek@gmail.com>
 */
class UpdateTopRatedMoviesFactory
{
    public function __invoke(ContainerInterface $container): UpdateTopRatedMovies
    {
        $tmdbApiService = $container->get(TMDBApiService::class);
        return new UpdateTopRatedMovies($tmdbApiService);
    }
}
