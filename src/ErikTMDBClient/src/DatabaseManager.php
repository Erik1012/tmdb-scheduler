<?php

/*
 *  All rights reserved © 2020 Eptech.
 */

namespace Erik\ErikTMDBClient;

use Erik\ErikTMDBClient\Repositories\DirectorRepositoryInterface;
use Erik\ErikTMDBClient\Repositories\GenreRepositoryInterface;
use Erik\ErikTMDBClient\Repositories\MovieRepositoryInterface;
use Erik\ErikTMDBClient\Resources\Director;
use Erik\ErikTMDBClient\Resources\Genre;
use Erik\ErikTMDBClient\Resources\Movie;
use Erik\ErikTMDBClient\Resources\MovieCollection;

/**
 * Description of DatabaseManager
 *
 * @author Polácsek Erik<erikpolachek@gmail.com>
 */
class DatabaseManager implements DatabaseManagerInterface
{
    private DirectorRepositoryInterface $directorRepository;
    private GenreRepositoryInterface $genreRepository;
    private MovieRepositoryInterface $movieRepository;

    public function __construct(
        DirectorRepositoryInterface $directorRepository,
        GenreRepositoryInterface $genreRepository,
        MovieRepositoryInterface $movieRepository
    ) {
        $this->directorRepository = $directorRepository;
        $this->genreRepository = $genreRepository;
        $this->movieRepository = $movieRepository;
    }

    public function clearTopMoviesList(): void
    {
        $this->movieRepository->clearMovieGenreRelationTable();
        $this->movieRepository->clearMoviesTable();
    }

    public function saveTopRatedMovies(MovieCollection $movies): void
    {
        foreach ($movies as $movie) {
            /** @var Movie $movie **/
            $this->movieRepository->insertMovie($movie);
        }
    }

    public function getDirectorId(Director $director): int
    {
        $directorFromDb = $this->directorRepository->getDirectorByTMDBId($director->getTmdbId());
        if (!is_null($directorFromDb)) {
            return $directorFromDb->getId();
        }

        return $this->directorRepository->insertDirector($director);
    }

    public function getGenreId(Genre $genre): int
    {
        $genreFromDb = $this->genreRepository->getGenreByTMDBId($genre->getTmdbId());
        if (!is_null($genreFromDb)) {
            return $genreFromDb->getId();
        }

        return $this->genreRepository->insertGenre($genre);
    }
}
