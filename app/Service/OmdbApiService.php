<?php


namespace App\Service;


use GuzzleHttp\Client;

class OmdbApiService implements OmdbApiServiceInterface
{
    /** @var Client  */
    private $client;

    public function __construct()
    {
        $this->client = new Client(
            ['base_uri' => 'http://www.omdbapi.com']
        );
    }

    /**
     * Search film by title.
     *
     * @param string $title
     * @return array
     */
    public function searchFilmByTitle(string $title): array
    {
        $request = $this->client->get('', [
           'query' => [
               't' => $title,
               'apikey' => $this->getApiKey()
           ]
        ]);

        return $this->getResponse($request);
    }

    /**
     * Search film by IMDB id.
     *
     * @param string $imdbId
     * @return array
     */
    public function searchFilmByImdbId(string $imdbId): array
    {
        $request = $this->client->get('', [
            'query' => [
                'i' => $imdbId,
                'apikey' => $this->getApiKey()
            ]
        ]);

        return $this->getResponse($request);
    }

    private function getApiKey(): string
    {
        return config('app.omdb_api_key');
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $request
     * @return mixed
     * @throws \Exception
     */
    private function getResponse(\Psr\Http\Message\ResponseInterface $request): array
    {
        $response = json_decode($request->getBody()->getContents(), true);
        if (isset($response['Error'])) {
            throw new \Exception('Film not found');
        }
        return $response;
    }
}
