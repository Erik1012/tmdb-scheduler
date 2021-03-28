<?php

/*
 *  All rights reserved © 2020 Eptech.
 */

declare(strict_types=1);

namespace Erik\ErikTMDBCron;

use Erik\ErikTMDBClient\TMDBApiService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Description of UpdateTopRatedMovies
 *
 * @author Polácsek Erik<erikpolachek@gmail.com>
 */
class UpdateTopRatedMovies extends Command
{
    private TMDBApiService $tmdbApiService;

    public function __construct(TMDBApiService $tmdbApiService, mixed $name = null)
    {
        parent::__construct($name);
        $this->tmdbApiService = $tmdbApiService;
    }

    protected function configure()
    {
        parent::configure();
        $this->setName('sync');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->tmdbApiService->updateMovieList();

        return 0;
    }
}
