<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Shopify Api
    |--------------------------------------------------------------------------
    |
    | This file is for setting the credentials for shopify api key and secret.
    |
    */

    'key' => env("SHOPIFY_APIKEY", null),
    'secret' => env("SHOPIFY_SECRET", null),
    'api_version' =>env('SHOPIFY_API_VERSION','2019-10'),
    'api_key' =>env('SHOPIFY_APIKEY','2019-10'),
    'redirect_url' =>env('SHOPIFY_REDIRECT_URL','2019-10'),
    'directory_name' =>env('DIRECTORY_NAME','2019-10'),
    'professional_plan_price' =>env('Professional_Plan_PRICE', 19),
    'elite_plan_price' =>env('Elite_Plan_PRICE', 29),
    'app_test_mode' => env('APP_TEST_MODE', false),
    'scope' =>env('SHOPIFY_SCOPE','read_themes,read_products,read_customers,read_orders,read_draft_orders,read_inventory,read_locations,read_fulfillments,read_checkouts,read_locales,read_shopify_payments_disputes'),
];