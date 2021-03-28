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
 * Description of MovieCollection
 *
 * @author Polácsek Erik<erikpolachek@gmail.com>
 */
class MovieCollection implements IteratorAggregate, Countable
{
    /**
     * @var Movie[]
     */
    private $movies;

    public function __construct(Movie ...$movie)
    {
        $this->movies = $movie;
    }

    public function count(): int
    {
        return count($this->movies);
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->movies);
    }
}
