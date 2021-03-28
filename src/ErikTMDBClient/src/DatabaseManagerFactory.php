<?php

/*
 *  All rights reserved © 2020 Eptech.
 */

namespace Erik\ErikTMDBClient;

use Erik\ErikTMDBClient\Repositories\DirectorRepositoryInterface;
use Erik\ErikTMDBClient\Repositories\GenreRepositoryInterface;
use Erik\ErikTMDBClient\Repositories\MovieRepositoryInterface;
use Psr\Container\ContainerInterface;

/**
 * Description of DatabaseManagerFactory
 *
 * @author Polácsek Erik<erikpolachek@gmail.com>
 */
class DatabaseManagerFactory
{
    public function __invoke(ContainerInterface $container): DatabaseManagerInterface
    {
        $directorRepository = $container->get(DirectorRepositoryInterface::class);
        $genreRepository = $container->get(GenreRepositoryInterface::class);
        $movieRepository = $container->get(MovieRepositoryInterface::class);
        return new DatabaseManager($directorRepository, $genreRepository, $movieRepository);
    }
}
