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
                'belongs_to_collection' => [
                    'id' => 489724,
                    'name' => 'The Trolls Collection',
                    'poster_path' => '/i4aII37O184x7K3dC7fpF9CAfS4.jpg',
                    'backdrop_path' => '/xtgonS6wcxK5RfnWWohYZF3mhjM.jpg',
                ],
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
                'imdb_id' => 'tt14362112',
                'original_language' => 'en',
                'original_title' => 'Trolls Band Together',
                'overview' => 'When Branch’s brother, Floyd, is kidnapped for his musical talents by a pair of nefarious pop-star villains, Branch and Poppy embark on a harrowing and emotional journey to reunite the other brothers and rescue Floyd from a fate even worse than pop-culture obscurity.',
                'popularity' => 853.007,
                'poster_path' => '/bkpPTZUdq31UGDovmszsg2CchiI.jpg',
                'production_companies' => [
                    [
                        'id' => 521,
                        'logo_path' => '/kP7t6RwGz2AvvTkvnI1uteEwHet.png',
                        'name' => 'DreamWorks Animation',
                        'origin_country' => 'US',
                    ],
                    [
                        'id' => 33,
                        'logo_path' => '/8lvHyhjr8oUKOOy2dKXoALWKdp0.png',
                        'name' => 'Universal Pictures',
                        'origin_country' => 'US',
                    ],
                ],
                'production_countries' => [
                    [
                        'iso_3166_1' => 'US',
                        'name' => 'United States of America',
                    ],
                ],
                'release_date' => '2023-10-12',
                'revenue' => 107900000,
                'runtime' => 92,
                'spoken_languages' => [
                    [
                        'english_name' => 'English',
                        'iso_639_1' => 'en',
                        'name' => 'English',
                    ],
                ],
                'status' => 'Released',
                'tagline' => 'There are some new trolls on the block.',
                'title' => 'Trolls Band Together',
                'video' => false,
                'vote_average' => 6.6,
                'vote_count' => 59,
            ],
            [
                'adult' => false,
                'backdrop_path' => '/fm6KqXpk3M2HVveHwCrBSSBaO0V.jpg',
                'belongs_to_collection' => null,
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
                'imdb_id' => 'tt15398776',
                'original_language' => 'en',
                'original_title' => 'Oppenheimer',
                'overview' => 'The story of J. Robert Oppenheimer\'s role in the development of the atomic bomb during World War II.',
                'popularity' => 1872.135,
                'poster_path' => '/8Gxv8gSFCU0XGDykEGv7zR1n2ua.jpg',
                'production_companies' => [
                    [
                        'id' => 9996,
                        'logo_path' => '/3tvBqYsBhxWeHlu62SIJ1el93O7.png',
                        'name' => 'Syncopy',
                        'origin_country' => 'GB',
                    ],
                    [
                        'id' => 33,
                        'logo_path' => '/8lvHyhjr8oUKOOy2dKXoALWKdp0.png',
                        'name' => 'Universal Pictures',
                        'origin_country' => 'US',
                    ],
                    [
                        'id' => 507,
                        'logo_path' => '/aRmHe6GWxYMRCQljF75rn2B9Gv8.png',
                        'name' => 'Atlas Entertainment',
                        'origin_country' => 'US',
                    ],
                ],
                'production_countries' => [
                    [
                        'iso_3166_1' => 'GB',
                        'name' => 'United Kingdom',
                    ],
                    [
                        'iso_3166_1' => 'US',
                        'name' => 'United States of America',
                    ],
                ],
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
                'status' => 'Released',
                'tagline' => 'The world forever changes.',
                'title' => 'Oppenheimer',
                'video' => false,
                'vote_average' => 8.2,
                'vote_count' => 4748,
            ],
        ];

        // Return movie with matching id
        return Arr::first($movies, fn ($movie) => $movie['id'] === $id);
    }
}
