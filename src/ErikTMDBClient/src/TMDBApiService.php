<?php

/*
 *  All rights reserved © 2020 Eptech.
 */

declare(strict_types=1);

namespace Erik\ErikTMDBClient;

use DateTimeImmutable;
use Erik\ErikTMDBClient\Providers\TMDBApiUrlProviderInterface;
use Erik\ErikTMDBClient\Resources\Director;
use Erik\ErikTMDBClient\Resources\Genre;
use Erik\ErikTMDBClient\Resources\GenreCollection;
use Erik\ErikTMDBClient\Resources\Movie;
use Erik\ErikTMDBClient\Resources\MovieCollection;

/**
 * Description of TMDBApiService
 *
 * @author Polácsek Erik<erikpolachek@gmail.com>
 */
class TMDBApiService
{
    private const NEEDED_MOVIES_COUNT = 210;

    private TMDBApiUrlProviderInterface $urlProvider;
    private TMDBApiHTTPClientInterface $apiHttpClient;
    private DatabaseManagerInterface $databaseManager;

    public function __construct(
        TMDBApiUrlProviderInterface $urlProvider,
        TMDBApiHTTPClientInterface $apiHttpClient,
        \Erik\ErikTMDBClient\DatabaseManagerInterface $databaseManager
    ) {
        $this->urlProvider = $urlProvider;
        $this->apiHttpClient = $apiHttpClient;
        $this->databaseManager = $databaseManager;
    }

    public function updateMovieList(): void
    {
        $topRatedMovies = $this->getTopRatedMovies(self::NEEDED_MOVIES_COUNT);

        $this->databaseManager->clearTopMoviesList();
        $this->databaseManager->saveTopRatedMovies($topRatedMovies);
    }

    private function getTopRatedMovies(int $neededMoviesCount): MovieCollection
    {
        $itemsPerPage = 20;
        $pagesCount = ceil($neededMoviesCount / $itemsPerPage);

        $moviesData = [];

        for ($i = 1; $i <= $pagesCount; $i++) {

            $url = $this->urlProvider->getTopRatedMoviesUrl($i);
            $responseData = $this->apiHttpClient->getDataByUrl($url);
            $moviesData = array_merge($moviesData, $responseData['results']);
        }

        $movieObjects = [];
        $count = 1;
        foreach ($moviesData as $movieData) {
            if ($count > $neededMoviesCount) {
                continue;
            }

            $movieObjects[] = $this->createMovieObject((int)$movieData['id']);
            $count++;
        }

        return new MovieCollection(... $movieObjects);

    }

    private function createMovieObject(int $movieId): Movie
    {
        $url = $this->urlProvider->getMovieDataUrl($movieId);
        $movieData = $this->apiHttpClient->getDataByUrl($url);

        $director = $this->getMovieDirector($movieId);
        $genres = $this->createGenreCollection($movieData['genres']);


        $movie = new Movie(
            $movieData['title'],
            $movieData['runtime'],
            new DateTimeImmutable($movieData['release_date']),
            $movieData['overview'],
            $this->urlProvider->getMoviePosterUrl($movieData['poster_path']),
            $movieData['id'],
            $movieData['vote_average'],
            $movieData['vote_count'],
            $this->urlProvider->getMoviePageUrl($movieId),
            $genres,
            $director
        );

        return $movie;
    }

    private function getMovieDirector(int $movieId): Director
    {
        $url = $this->urlProvider->getMovieCastUrl($movieId);
        $castData = $this->apiHttpClient->getDataByUrl($url);

        foreach ($castData['crew'] as $crewData) {
            if (isset($crewData['job']) && $crewData['job'] === "Director") {
                $url = $this->urlProvider->getPersonDataUrl((int)$crewData['id']);
                $personData = $this->apiHttpClient->getDataByUrl($url);
                $director = new Director(
                    $personData['name'],
                    (int)$crewData['id'],
                    $personData['biography'],
                    is_null($personData['birthday']) ? null : new DateTimeImmutable($personData['birthday'])
                );
                $directorDbId = $this->databaseManager->getDirectorId($director);

                return new Director(
                    $personData['name'],
                    (int)$crewData['id'],
                    $personData['biography'],
                    is_null($personData['birthday']) ? null : new DateTimeImmutable($personData['birthday']),
                    $directorDbId
                );
            }
        }

        return null;
    }

    private function createGenreCollection(array $genresData): GenreCollection
    {
        $genres = [];
        foreach ($genresData as $genreData) {
            $genre = new Genre($genreData['name'], $genreData['id']);
            $genreId = $this->databaseManager->getGenreId($genre);
            $genres[] = new Genre($genreData['name'], $genreData['id'], $genreId);
        }

        return new GenreCollection(... $genres);
    }
}
