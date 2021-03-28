<?php

/*
 *  All rights reserved © 2020 Eptech.
 */

declare (strict_types=1);

namespace Erik\ErikTMDBClient\Repositories;

use PDO;
use Psr\Container\ContainerInterface;

/**
 * Description of MovieRepositoryFactory
 *
 * @author Polácsek Erik<erikpolachek@gmail.com>
 */
class MovieRepositoryFactory
{
    public function __invoke(ContainerInterface $container): MovieRepositoryInterface
    {
        $pdo = $container->get(PDO::class);
        return new MovieRepository($pdo);
    }
}
