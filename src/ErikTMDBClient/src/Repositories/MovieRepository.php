<?php

/*
 *  All rights reserved © 2020 Eptech.
 */

declare (strict_types=1);

namespace Erik\ErikTMDBClient\Repositories;

use Erik\ErikTMDBClient\Resources\Genre;
use Erik\ErikTMDBClient\Resources\GenreCollection;
use Erik\ErikTMDBClient\Resources\Movie;
use PDO;

/**
 * Description of MovieRepository
 *
 * @author Polácsek Erik<erikpolachek@gmail.com>
 */
class MovieRepository implements MovieRepositoryInterface
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function clearMoviesTable(): void
    {
        $query = <<<SQL
            DELETE FROM movies
        SQL;
        $statement = $this->pdo->prepare($query);
        $statement->execute();
    }

    public function clearMovieGenreRelationTable(): void
    {
        $query = <<<SQL
            DELETE FROM movies_genres
        SQL;
        $statement = $this->pdo->prepare($query);
        $statement->execute();
    }

    public function insertMovie(Movie $movie): void
    {
        $query = <<<SQL
            INSERT INTO movies
                (title, length, release_date, overview, poster_url, tmdb_id,
                    tmdb_vote_avarage, tmdb_vote_count, tmdb_url, director_id)
            VALUES
                (:title, :length, :releaseDate, :overview, :posterUrl, :tmdbId,
                    :tmdbVoteAvarage, :tmdbVoteCount, :tmdbUrl, :directorId)
        SQL;
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('title', $movie->getTitle());
        $statement->bindValue('length', $movie->getLength());
        $statement->bindValue('releaseDate', $movie->getReleaseDate()->format("Y-m-d"));
        $statement->bindValue('overview', $movie->getOverview());
        $statement->bindValue('posterUrl', $movie->getPosterUrl());
        $statement->bindValue('tmdbVoteAvarage', $movie->getTmdbVoteAvarage());
        $statement->bindValue('tmdbVoteCount', $movie->getTmdbVoteCount());
        $statement->bindValue('directorId', $movie->getDirector()->getId());
        $statement->bindValue('tmdbUrl', $movie->getTmdbUrl());
        $statement->bindValue('tmdbId', $movie->getTmdbId());
        $statement->execute();

        $movieId = (int)$this->pdo->lastInsertId();
        $this->saveMovieGenreRelations($movieId, $movie->getGenres());
    }

    private function saveMovieGenreRelations(int $movieId, GenreCollection $genres): void
    {
        foreach ($genres as $genre) {
            /** @var Genre $genre */
            $this->insertMovieGenreRelation($movieId, $genre->getId());
        }
    }

    private function insertMovieGenreRelation(int $movieId, int $genreId): void
    {
        $query = <<<SQL
            INSERT INTO movies_genres
                (movie_id, genre_id)
            VALUES
                (:movieId, :genreId)
        SQL;
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('movieId', $movieId);
        $statement->bindValue('genreId', $genreId);
        $statement->execute();
    }
}
