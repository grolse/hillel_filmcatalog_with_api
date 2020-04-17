<?php


namespace App\Service;


interface OmdbApiServiceInterface
{
    /**
     * Search film by title.
     *
     * @param string $title
     * @return array
     */
    public function searchFilmByTitle(string $title): array;

    /**
     * Search film by IMDB id.
     *
     * @param string $imdbId
     * @return array
     */
    public function searchFilmByImdbId(string $imdbId): array;
}
