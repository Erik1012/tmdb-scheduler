<?php

/*
 *  All rights reserved © 2020 Eptech.
 */

declare(strict_types=1);

namespace Erik\ErikTMDBClient\Providers;

/**
 *
 * @author Polácsek Erik<erikpolachek@gmail.com>
 */
interface TMDBApiUrlProviderInterface
{
    public function getTopRatedMoviesUrl(int $page): string;
    public function getMovieDataUrl(int $movieId): string;
    public function getMovieGenresListUrl(): string;
    public function getMovieCastUrl(int $movieId): string;
    public function getPersonDataUrl(int $personId): string;
    public function getMoviePageUrl(int $movieId): string;
    public function getMoviePosterUrl(string $posterUrl): string;
}
