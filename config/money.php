<?php

return [
    /*
     |--------------------------------------------------------------------------
     | Laravel money
     |--------------------------------------------------------------------------
     */
    'locale' => config('app.locale', 'nl_NL'),
    'defaultCurrency' => config('app.currency', 'EUR'),
    'defaultFormatter' => null,
    'isoCurrenciesPath' => __DIR__.'/../vendor/moneyphp/money/resources/currency.php',
    'currencies' => [
        'iso' => 'all',
        'bitcoin' => 'all',
        'custom' => [
            // 'MY1' => 2,
            // 'MY2' => 3
        ],
    ],
];
