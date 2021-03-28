<?php

/*
 *  All rights reserved © 2020 Eptech.
 */

declare(strict_types=1);

namespace Erik\ErikTMDBClient\Resources;

/**
 * Description of Genre
 *
 * @author Polácsek Erik<erikpolachek@gmail.com>
 */
class Genre
{
    private ?int $id;
    private string $name;
    private int $tmdbId;

    public function __construct(string $name, int $tmdbId, int $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->tmdbId = $tmdbId;
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
}
