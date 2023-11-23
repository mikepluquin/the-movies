<?php

namespace Tests\Mocks\API;

use Illuminate\Support\Arr;

class TheMovie
{
    /**
     * @return array
     */
    public static function getMovies(): array
    {
        return [
            'results' => [
                [
                    'id' => 872585,
                ],
                [
                    'id' => 901362,
                ],
            ],
        ];
    }

    /**
     * @param int $id
     *
     * @return array|null
     */
    public static function getMovie(int $id): ?array
    {
        $movies = [
            [
                'adult' => false,
                'backdrop_path' => '/xgGGinKRL8xeRkaAR9RMbtyk60y.jpg',
                'budget' => 95000000,
                'genres' => [
                    [
                        'id' => 16,
                        'name' => 'Animation',
                    ],
                    [
                        'id' => 10751,
                        'name' => 'Family',
                    ],
                    [
                        'id' => 10402,
                        'name' => 'Music',
                    ],
                    [
                        'id' => 14,
                        'name' => 'Fantasy',
                    ],
                    [
                        'id' => 35,
                        'name' => 'Comedy',
                    ],
                ],
                'homepage' => 'https://www.dreamworks.com/movies/trolls-band-together',
                'id' => 901362,
                'overview' => 'When Branch’s brother, Floyd, is kidnapped for his musical talents by a pair of nefarious pop-star villains, Branch and Poppy embark on a harrowing and emotional journey to reunite the other brothers and rescue Floyd from a fate even worse than pop-culture obscurity.',
                'poster_path' => '/bkpPTZUdq31UGDovmszsg2CchiI.jpg',
                'release_date' => '2023-10-12',
                'revenue' => 107900000,
                'runtime' => 92,
                'title' => 'Trolls Band Together',
                'vote_average' => 6.6,
                'vote_count' => 59,
            ],
            [
                'adult' => false,
                'backdrop_path' => '/fm6KqXpk3M2HVveHwCrBSSBaO0V.jpg',
                'budget' => 100000000,
                'genres' => [
                    [
                        'id' => 18,
                        'name' => 'Drama',
                    ],
                    [
                        'id' => 36,
                        'name' => 'History',
                    ],
                ],
                'homepage' => 'http://www.oppenheimermovie.com',
                'id' => 872585,
                'overview' => 'The story of J. Robert Oppenheimer\'s role in the development of the atomic bomb during World War II.',
                'poster_path' => '/8Gxv8gSFCU0XGDykEGv7zR1n2ua.jpg',
                'release_date' => '2023-07-19',
                'revenue' => 950200000,
                'runtime' => 181,
                'spoken_languages' => [
                    [
                        'english_name' => 'Dutch',
                        'iso_639_1' => 'nl',
                        'name' => 'Nederlands',
                    ],
                    [
                        'english_name' => 'English',
                        'iso_639_1' => 'en',
                        'name' => 'English',
                    ],
                ],
                'tagline' => 'The world forever changes.',
                'title' => 'Oppenheimer',
                'vote_average' => 8.2,
                'vote_count' => 4748,
            ],
        ];

        // Return movie with matching id
        return Arr::first($movies, fn ($movie) => $movie['id'] === $id);
    }
}
