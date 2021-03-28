<?php

/*
 *  All rights reserved © 2020 Eptech.
 */

declare(strict_types=1);

namespace Erik\ErikTMDBClient\Providers;

use Psr\Container\ContainerInterface;

/**
 * Description of TMDBApiUrlProviderFactory
 *
 * @author Polácsek Erik<erikpolachek@gmail.com>
 */
class TMDBApiUrlProviderFactory
{
    public function __invoke(ContainerInterface $container): TMDBApiUrlProviderInterface
    {
        $config = $container->get('config');
        $apiKey = $config['TMDBApiKey'];
        return new TMDBApiUrlProvider($apiKey);
    }
}
