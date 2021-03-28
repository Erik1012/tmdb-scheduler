<?php

/*
 *  All rights reserved © 2020 Eptech.
 */

declare(strict_types=1);

namespace Erik\ErikTMDBClient\Resources;

use DateTimeImmutable;

/**
 * Description of Director
 *
 * @author Polácsek Erik<erikpolachek@gmail.com>
 */
class Director
{
    private ?int $id;
    private string $name;
    private int $tmdbId;
    private string $biography;
    private ?DateTimeImmutable $dateOfBirth;

    public function __construct(
        string $name,
        int $tmdbId,
        string $biography,
        ?DateTimeImmutable $dateOfBirth,
        int $id = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->tmdbId = $tmdbId;
        $this->biography = $biography;
        $this->dateOfBirth = $dateOfBirth;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTmdbId(): int
    {
        return $this->tmdbId;
    }

    public function getBiography(): string
    {
        return $this->biography;
    }

    public function getDateOfBirth(): ?DateTimeImmutable
    {
        return $this->dateOfBirth;
    }
}
