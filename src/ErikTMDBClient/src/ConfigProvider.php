<?php

/*
 *  All rights reserved © 2020 Eptech.
 */

declare(strict_types=1);

namespace Erik\ErikTMDBClient;

use Erik\ErikTMDBClient\Providers\TMDBApiUrlProvider;
use Erik\ErikTMDBClient\Providers\TMDBApiUrlProviderFactory;
use Erik\ErikTMDBClient\Providers\TMDBApiUrlProviderInterface;
use Erik\ErikTMDBClient\Repositories\DirectorRepository;
use Erik\ErikTMDBClient\Repositories\DirectorRepositoryFactory;
use Erik\ErikTMDBClient\Repositories\DirectorRepositoryInterface;
use Erik\ErikTMDBClient\Repositories\GenreRepository;
use Erik\ErikTMDBClient\Repositories\GenreRepositoryFactory;
use Erik\ErikTMDBClient\Repositories\GenreRepositoryInterface;
use Erik\ErikTMDBClient\Repositories\MovieRepository;
use Erik\ErikTMDBClient\Repositories\MovieRepositoryFactory;
use Erik\ErikTMDBClient\Repositories\MovieRepositoryInterface;
use PDO;

/**
 * Description of ConfigProvider
 *
 * @author Polácsek Erik<erikpolachek@gmail.com>
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'aliases' => [
                TMDBApiUrlProviderInterface::class => TMDBApiUrlProvider::class,
                TMDBApiHTTPClientInterface::class => TMDBApiHTTPClient::class,
                DirectorRepositoryInterface::class => DirectorRepository::class,
                GenreRepositoryInterface::class => GenreRepository::class,
                MovieRepositoryInterface::class => MovieRepository::class,
                DatabaseManagerInterface::class => DatabaseManager::class,
            ],
            'invokables' => [

            ],
            'factories'  => [
                PDO::class => PdoFactory::class,
                TMDBApiHTTPClient::class => TMDBApiHTTPClientFactory::class,
                DatabaseManager::class => DatabaseManagerFactory::class,

                //Services
                TMDBApiService::class => TMDBApiServiceFactory::class,

                //Providers
                TMDBApiUrlProvider::class => TMDBApiUrlProviderFactory::class,

                //Repositories
                DirectorRepository::class => DirectorRepositoryFactory::class,
                GenreRepository::class => GenreRepositoryFactory::class,
                MovieRepository::class => MovieRepositoryFactory::class,
            ],
        ];
    }
}
