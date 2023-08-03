<?php

return [
    /*
     * providers users named parameters to be passed to the constructor of the provider class
     * So please be aware that they are case-sensitive
     * Also the class property is required and should be the FQCN of the provider class
     * Finally the name of the provider should be the same as the class
     */


    // The default has to be a provider that is defined in the providers array
    'default' => env('WEATHER_PROVIDER', 'BlueSky'),

    'providers' => [
        'BlueSky' => [
            'class' => \App\Weather\Consumers\BlueSky::class,
            'apiKey' => env('BLUE_SKY_API_KEY', null),
        ],
    ],
];
