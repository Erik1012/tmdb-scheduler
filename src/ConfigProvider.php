<?php

/*
 *  All rights reserved © 2020 Eptech.
 */

declare(strict_types=1);

namespace Erik\ErikTMDBCron;

use Erik\ErikTMDBClient\PdoFactory;
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

            ],
            'invokables' => [

            ],
            'factories'  => [
                PDO::class => PdoFactory::class,
                UpdateTopRatedMovies::class => UpdateTopRatedMoviesFactory::class,
            ],
        ];
    }
}
