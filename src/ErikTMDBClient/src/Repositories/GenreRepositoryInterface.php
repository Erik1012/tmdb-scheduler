<?php

/*
 *  All rights reserved © 2020 Eptech.
 */

declare (strict_types=1);

namespace Erik\ErikTMDBClient\Repositories;

use Erik\ErikTMDBClient\Resources\Genre;

/**
 *
 * @author Polácsek Erik<erikpolachek@gmail.com>
 */
interface GenreRepositoryInterface
{
    public function getGenreByTMDBId(int $tmdbId): ?Genre;
    public function insertGenre(Genre $genre): int;
}
