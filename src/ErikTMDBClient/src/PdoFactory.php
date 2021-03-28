<?php

/*
 *  All rights reserved © 2020 Eptech.
 */

declare(strict_types=1);

namespace Erik\ErikTMDBClient;

use PDO;
use Psr\Container\ContainerInterface;

/**
 * Description of PdoFactory
 *
 * @author Polácsek Erik<erikpolachek@gmail.com>
 */
class PdoFactory
{
    public function __invoke(ContainerInterface $container): PDO
    {
        $config = $container->get('config');
        return new PDO(
            $config['database']['dsn'],
            $config['database']['user'],
            $config['database']['password'],
            $config['database']['options']
        );
    }
}
