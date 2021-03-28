<?php

/*
 *  All rights reserved © 2020 Eptech.
 */

declare(strict_types=1);

namespace Erik\ErikTMDBClient\Providers;

/**
 * Description of TMDBApiUrlProvider
 *
 * @author Polácsek Erik<erikpolachek@gmail.com>
 */
class TMDBApiUrlProvider implements TMDBApiUrlProviderInterface
{
    private const TOP_RATED_MOVIES_URL = "https://api.themoviedb.org/3/movie/top_rated?api_key=<<api_key>>&language=en-US&page=";
    private const MOVIE_DATA_URL = "https://api.themoviedb.org/3/movie/{movie_id}?api_key=<<api_key>>&language=en-US";
    private const MOVIE_GENRES_LIST_URL = "https://api.themoviedb.org/3/genre/movie/list?api_key=<<api_key>>&language=en-US";
    private const MOVIE_CAST_DATA_URL = "https://api.themoviedb.org/3/movie/{movie_id}/credits?api_key=<<api_key>>&language=en-US";
    private const PERSON_DATA_URL = "https://api.themoviedb.org/3/person/{person_id}?api_key=<<api_key>>&language=en-US";
    private const MOVIE_PAGE_URL = "https://www.themoviedb.org/movie/{movie_id}";
    private const MOVIE_POSTER_URL = "https://image.tmdb.org/t/p/original{poster_url}";

    private string $tmdbApiKey;

    public function __construct(string $tmdbApiKey)
    {
        $this->tmdbApiKey = $tmdbApiKey;
    }

    private function insertApiKeyToUrl(string $url): string
    {
        return str_replace('<<api_key>>', $this->tmdbApiKey, $url);
    }

    public function getTopRatedMoviesUrl(int $page): string
    {
        $url = $this->insertApiKeyToUrl(self::TOP_RATED_MOVIES_URL);
        return $url.$page;
    }

    public function getMovieDataUrl(int $movieId): string
    {
        $url = $this->insertApiKeyToUrl(self::MOVIE_DATA_URL);
        return str_replace("{movie_id}", $movieId, $url);
    }

    public function getMovieGenresListUrl(): string
    {
        return $this->insertApiKeyToUrl(self::MOVIE_GENRES_LIST_URL);
    }

    public function getMovieCastUrl(int $movieId): string
    {
        $url = $this->insertApiKeyToUrl(self::MOVIE_CAST_DATA_URL);
        return str_replace("{movie_id}", $movieId, $url);
    }

    public function getPersonDataUrl(int $personId): string
    {
        $url = $this->insertApiKeyToUrl(self::PERSON_DATA_URL);
        return str_replace("{person_id}", $personId, $url);
    }

    public function getMoviePageUrl(int $movieId): string
    {
        return str_replace("{movie_id}", $movieId, self::MOVIE_PAGE_URL);
    }

    public function getMoviePosterUrl(string $posterUrl): string
    {
        return str_replace("{poster_url}", $posterUrl, self::MOVIE_POSTER_URL);
    }
}
