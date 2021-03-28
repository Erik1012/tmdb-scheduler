<?php

/*
 *  All rights reserved © 2020 Eptech.
 */

declare (strict_types=1);

namespace Erik\ErikTMDBClient\Repositories;

use DateTimeImmutable;
use Erik\ErikTMDBClient\Resources\Director;
use PDO;

/**
 * Description of DirectorRepository
 *
 * @author Polácsek Erik<erikpolachek@gmail.com>
 */
class DirectorRepository implements DirectorRepositoryInterface
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getDirectorByTMDBId(int $tmdbId): ?Director
    {
        $query = <<<SQL
            SELECT * FROM
                directors
            WHERE
                tmdb_id = :tmdbId
        SQL;
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('tmdbId', $tmdbId);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if($row) {
            return new Director(
                $row['name'],
                (int)$row['tmdb_id'],
                $row['biography'],
                is_null($row['date_of_birth']) ? null : new DateTimeImmutable($row['date_of_birth']),
                (int)$row['id']
            );
        }

        return null;
    }

    public function insertDirector(Director $director): int
    {
        $query = <<<SQL
            INSERT INTO directors
                (name, tmdb_id, biography, date_of_birth)
            VALUES
                (:name, :tmdbId, :biography, :dateOfBirth)
        SQL;
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('name', $director->getName());
        $statement->bindValue('tmdbId', $director->getTmdbId());
        $statement->bindValue('biography', $director->getBiography());
        $statement->bindValue('dateOfBirth', is_null($director->getDateOfBirth()) ? null
            : $director->getDateOfBirth()->format("Y-m-d H:i:s"));
        $statement->execute();

        return (int)$this->pdo->lastInsertId();
    }
}
