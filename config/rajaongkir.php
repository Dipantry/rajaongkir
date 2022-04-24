<?php

return [
    /*
     * Get your API Key from rajaongkir.com by registering your account
     */
    'api_key' => env('RAJAONGKIR_API_KEY', ''),

    /*
     * Set your account package type
     * Example: basic, starter, pro
     */
    'package' => env('RAJAONGKIR_PACKAGE', 'starter'),

    /*
     * Table name settings for caching provinces, cities, and districts
     */
    'table_prefix' => 'rajaongkir_',

    /*
     * Set the connection timeout for the requests
     */
    'timeout' => env('RAJAONGKIR_TIMEOUT', 30),
];
