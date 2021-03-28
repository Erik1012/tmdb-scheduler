<?php

/*
 *  All rights reserved © 2020 Eptech.
 */

declare (strict_types=1);

namespace Erik\ErikTMDBClient\Repositories;

use PDO;
use Psr\Container\ContainerInterface;

/**
 * Description of DirectorRepositoryFactory
 *
 * @author Polácsek Erik<erikpolachek@gmail.com>
 */
class DirectorRepositoryFactory
{
    public function __invoke(ContainerInterface $container): DirectorRepositoryInterface
    {
        $pdo = $container->get(PDO::class);
        return new DirectorRepository($pdo);
    }
}
