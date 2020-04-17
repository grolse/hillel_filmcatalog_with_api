<?php


namespace App\Service;


use App\Models\Movies;

interface MovieServiceInterface
{
    /**
     * Get Movie by title.
     *
     * @param string $title
     * @throws \Exception
     * @return Movies
     */
    public function getFilm(string $title): Movies;
}
