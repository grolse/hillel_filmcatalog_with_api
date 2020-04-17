<?php


namespace App\Service;


use App\Models\Actors;
use App\Models\Movies;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class MovieService implements MovieServiceInterface
{
    /**
     * @var OmdbApiServiceInterface
     */
    private $apiService;

    public function __construct(OmdbApiServiceInterface $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * Get Movie by title.
     *
     * @param string $title
     * @return Movies
     * @throws \Exception
     */
    public function getFilm(string $title): Movies
    {
        $movie = Movies::where('title', 'like', '%'.$title.'%')->first();
        if (!$movie) {
            $movieData = $this->mapResponse($this->fetchMovie($title));
            $actorIds = [];
            foreach ($movieData['meta']['actors'] as $actor) {
                $actorFetched = Actors::where('name', $actor)->first();
                if (!$actorFetched) {
                    $actorObject = new Actors();
                    $actorObject->name = $actor;
                    $actorObject->save();
                    $actorIds[] = $actorObject->id;
                } else {
                    $actorIds[] = $actorFetched->id;
                }
            }
            $movie = new Movies();
            $movie->title = $movieData['title'];
            $movie->plot = $movieData['plot'];
            $movie->poster = $movieData['poster'];
            $movie->release = $movieData['release'];
            $movie->runtime = (int)$movieData['runtime'];
            $movie->country = $movieData['country'];
            $movie->imdb_id = $movieData['imdb_id'];
            $movie->save();

            $movie->actors()->attach($actorIds);
            $movie->save();
        }
        return $movie;
    }

    private function mapResponse(array $movieData): array
    {
        return [
            'title' => $movieData['Title'],
            'release' => $movieData['Released'],
            'plot' => $movieData['Plot'],
            'poster' => $movieData['Poster'],
            'runtime' => $movieData['Runtime'],
            'country' => $movieData['Country'],
            'imdb_id' => $movieData['imdbID'],
            'meta' => [
                'genre' => explode(',', $movieData['Genre']),
                'actors' => explode(',', $movieData['Actors']),
                'Director' => explode(',', $movieData['Director'])
            ]
        ];
    }

    private function fetchMovie(string $title)
    {
        return $this->apiService->searchFilmByTitle($title);
    }

}
