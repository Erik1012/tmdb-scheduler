<?php

/*
 *  All rights reserved © 2020 Eptech.
 */

declare (strict_types=1);

namespace Erik\ErikTMDBClient\Repositories;

use Erik\ErikTMDBClient\Resources\Movie;

/**
 *
 * @author Polácsek Erik<erikpolachek@gmail.com>
 */
interface MovieRepositoryInterface
{
    public function clearMoviesTable(): void;
    public function clearMovieGenreRelationTable(): void;
    public function insertMovie(Movie $movie): void;
}
