<?php

/*
 *  All rights reserved © 2020 Eptech.
 */

declare (strict_types=1);

namespace Erik\ErikTMDBClient\Repositories;

use PDO;
use Psr\Container\ContainerInterface;

/**
 * Description of GenreRepositoryFactory
 *
 * @author Polácsek Erik<erikpolachek@gmail.com>
 */
class GenreRepositoryFactory
{
    public function __invoke(ContainerInterface $container): GenreRepositoryInterface
    {
        $pdo = $container->get(PDO::class);
        return new GenreRepository($pdo);
    }
}
