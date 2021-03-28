<?php

/*
 *  All rights reserved © 2020 Eptech.
 */

namespace Erik\ErikTMDBClient;

use Erik\ErikTMDBClient\Resources\Director;
use Erik\ErikTMDBClient\Resources\Genre;
use Erik\ErikTMDBClient\Resources\MovieCollection;

/**
 *
 * @author Polácsek Erik<erikpolachek@gmail.com>
 */
interface DatabaseManagerInterface
{
    public function clearTopMoviesList(): void;
    public function saveTopRatedMovies(MovieCollection $movies): void;
    public function getDirectorId(Director $director): int;
    public function getGenreId(Genre $genre): int;
}
