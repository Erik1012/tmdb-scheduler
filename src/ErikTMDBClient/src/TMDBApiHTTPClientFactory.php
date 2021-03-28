<?php

/*
 *  All rights reserved © 2020 Eptech.
 */

declare(strict_types=1);

namespace Erik\ErikTMDBClient;

use GuzzleHttp\Client;
use Psr\Container\ContainerInterface;

/**
 * Description of TMDBApiHTTPClientFactory
 *
 * @author Polácsek Erik<erikpolachek@gmail.com>
 */
class TMDBApiHTTPClientFactory
{
    public function __invoke(ContainerInterface $container): TMDBApiHTTPClientInterface
    {
        $client = new Client();
        return new TMDBApiHTTPClient($client);
    }
}
