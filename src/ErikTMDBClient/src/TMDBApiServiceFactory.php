<?php

/*
 *  All rights reserved © 2020 Eptech.
 */

declare(strict_types=1);

namespace Erik\ErikTMDBClient;

use Erik\ErikTMDBClient\Providers\TMDBApiUrlProviderInterface;
use Psr\Container\ContainerInterface;

/**
 * Description of TMDBApiServiceFactory
 *
 * @author Polácsek Erik<erikpolachek@gmail.com>
 */
class TMDBApiServiceFactory
{
    public function __invoke(ContainerInterface $container): TMDBApiService
    {
        $tmdbApiUrlProvider = $container->get(TMDBApiUrlProviderInterface::class);
        $tmdbApiHttpClient = $container->get(TMDBApiHTTPClientInterface::class);
        $databaseManager = $container->get(DatabaseManagerInterface::class);
        return new TMDBApiService($tmdbApiUrlProvider, $tmdbApiHttpClient, $databaseManager);
    }
}
