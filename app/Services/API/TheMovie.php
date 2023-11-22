<?php

namespace App\Services\API;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Documentation:
 *   - https://developer.themoviedb.org/docs
 */
class TheMovie
{
    protected const BASE_URL = 'https://api.themoviedb.org/3/';

    protected string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('app.tmdb_api_key');
    }

    /**
     * Documentation :
     * - https://developer.themoviedb.org/reference/trending-movies
     *
     * @param array $params
     *
     * @return array|null
     */
    public function getMovies(array $params = []): ?array
    {
        return $this->callEndpoint('trending/movie/day', $params);
    }

    /**
     * Documentation :
     * - https://developer.themoviedb.org/reference/movie-details
     *
     * @param int $id
     * @param array $params
     *
     * @return array|null
     */
    public function getMovie(int $id, array $params = []): ?array
    {
        return $this->callEndpoint('movie/' . $id, $params);
    }

    /**
     * @param string $path
     * @param array $params
     *
     * @return array|null
     */
    protected function callEndpoint(string $path, array $params = []): ?array
    {
        $url = $this->getFullUrl($path);

        $response = Http::withToken($this->apiKey)
            ->get($url, $params)
            ->onError(function ($e) use ($url, $params): void {
                // Log error if there is one
                Log::warning('API Request failed', [
                    'code' => $e->getStatusCode(),
                    'reason' => $e->getReasonPhrase(),
                    'url' => $url,
                    'params' => $params,
                ]);
            });

        if ($response?->successful()) {
            return $response->json();
        }
        // Null is returned if request is not successful
        return null;
    }

    /**
     * Build full request's endpoint URL
     *
     * @param string $path
     *
     * @return string
     */
    protected function getFullUrl(string $path): string
    {
        return self::BASE_URL . $path;
    }
}
