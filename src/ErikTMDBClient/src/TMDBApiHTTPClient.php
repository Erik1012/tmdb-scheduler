<?php

/*
 *  All rights reserved © 2020 Eptech.
 */

declare(strict_types=1);

namespace Erik\ErikTMDBClient;

use Psr\Http\Client\ClientInterface;

/**
 * Description of TMDBApiHTTPClient
 *
 * @author Polácsek Erik<erikpolachek@gmail.com>
 */
class TMDBApiHTTPClient implements TMDBApiHTTPClientInterface
{
    private ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function getDataByUrl(string $url): ?array
    {
        $response = $this->client->request('GET', $url);

        $data = [];
        if ($response->getStatusCode() === 200) {
            $responseString = $response->getBody()->getContents();
            $data = json_decode($responseString, true);
            return $data;
        }

        return null;
    }
}
