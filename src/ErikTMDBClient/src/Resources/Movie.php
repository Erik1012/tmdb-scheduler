<?php

/*
 *  All rights reserved © 2020 Eptech.
 */

declare(strict_types=1);

namespace Erik\ErikTMDBClient\Resources;

use DateTimeImmutable;

/**
 * Description of Movie
 *
 * @author Polácsek Erik<erikpolachek@gmail.com>
 */
class Movie
{
    private ?int $id;
    private string $title;
    private int $length;
    private DateTimeImmutable $releaseDate;
    private string $overview;
    private string $posterUrl;
    private int $tmdbId;
    private float $tmdbVoteAvarage;
    private int $tmdbVoteCount;
    private string $tmdbUrl;
    private GenreCollection $genres;
    private ?Director $director;

    public function __construct(
        string $title,
        int $length,
        DateTimeImmutable $releaseDate,
        string $overview,
        string $posterUrl,
        int $tmdbId,
        float $tmdbVoteAvarage,
        int $tmdbVoteCount,
        string $tmdbUrl,
        GenreCollection $genres,
        ?Director $director,
        int $id = null
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->length = $length;
        $this->releaseDate = $releaseDate;
        $this->overview = $overview;
        $this->posterUrl = $posterUrl;
        $this->tmdbId = $tmdbId;
        $this->tmdbVoteAvarage = $tmdbVoteAvarage;
        $this->tmdbVoteCount = $tmdbVoteCount;
        $this->tmdbUrl = $tmdbUrl;
        $this->genres = $genres;
        $this->director = $director;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function getReleaseDate(): DateTimeImmutable
    {
        return $this->releaseDate;
    }

    public function getOverview(): string
    {
        return $this->overview;
    }

    public function getPosterUrl(): string
    {
        return $this->posterUrl;
    }

    public function getTmdbId(): int
    {
        return $this->tmdbId;
    }

    public function getTmdbVoteAvarage(): float
    {
        return $this->tmdbVoteAvarage;
    }

    public function getTmdbVoteCount(): int
    {
        return $this->tmdbVoteCount;
    }

    public function getTmdbUrl(): string
    {
        return $this->tmdbUrl;
    }

    public function getGenres(): GenreCollection
    {
        return $this->genres;
    }

    public function getDirector(): ?Director
    {
        return $this->director;
    }
}
