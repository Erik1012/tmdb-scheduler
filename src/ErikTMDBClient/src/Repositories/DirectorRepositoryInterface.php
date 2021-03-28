<?php

/*
 *  All rights reserved © 2020 Eptech.
 */

declare (strict_types=1);

namespace Erik\ErikTMDBClient\Repositories;

use Erik\ErikTMDBClient\Resources\Director;

/**
 *
 * @author Polácsek Erik<erikpolachek@gmail.com>
 */
interface DirectorRepositoryInterface
{
    public function getDirectorByTMDBId(int $tmdbId): ?Director;
    public function insertDirector(Director $director): int;
}
