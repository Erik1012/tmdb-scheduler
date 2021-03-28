<?php

/*
 *  All rights reserved © 2020 Eptech.
 */

declare(strict_types=1);

namespace Erik\ErikTMDBClient;

/**
 *
 * @author Polácsek Erik<erikpolachek@gmail.com>
 */
interface TMDBApiHTTPClientInterface
{
    public function getDataByUrl(string $url): ?array;
}
