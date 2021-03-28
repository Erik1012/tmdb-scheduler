<?php

/*
 *  All rights reserved © 2020 Eptech.
 */

declare (strict_types=1);

namespace Erik\ErikTMDBClient\Repositories;

use Erik\ErikTMDBClient\Resources\Genre;
use PDO;

/**
 * Description of GenreRepository
 *
 * @author Polácsek Erik<erikpolachek@gmail.com>
 */
class GenreRepository implements GenreRepositoryInterface
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getGenreByTMDBId(int $tmdbId): ?Genre
    {
        $query = <<<SQL
            SELECT * FROM
                genres
            WHERE
                tmdb_id = :tmdbId
        SQL;
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('tmdbId', $tmdbId);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if($row) {
            return new Genre($row['name'], (int)$row['tmdb_id'], (int)$row['id']);
        }

        return null;
    }

    public function insertGenre(Genre $genre): int
    {
        $query = <<<SQL
            INSERT INTO genres
                (name, tmdb_id)
            VALUES
                (:name, :tmdbId)
        SQL;
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('name', $genre->getName());
        $statement->bindValue('tmdbId', $genre->getTmdbId());
        $statement->execute();

        return (int)$this->pdo->lastInsertId();
    }
}
