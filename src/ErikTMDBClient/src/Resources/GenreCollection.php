<?php

/*
 *  All rights reserved © 2020 Eptech.
 */

declare (strict_types=1);

namespace Erik\ErikTMDBClient\Resources;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;

/**
 * Description of GenreCollection
 *
 * @author Polácsek Erik<erikpolachek@gmail.com>
 */
class GenreCollection implements IteratorAggregate, Countable
{
    /**
     * @var Genre[]
     */
    private $genres;

    public function __construct(Genre ...$genre)
    {
        $this->genres = $genre;
    }

    public function count(): int
    {
        return count($this->genres);
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->genres);
    }
}
