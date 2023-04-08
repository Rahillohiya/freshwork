<?php

return [
    /*
    |----------------------------------------------------------------------------
    | Constants variables
    |----------------------------------------------------------------------------
    */
//freshworks credential variables starts here

    "name" => env('channel_name', "freshworks_online"),
    "icon_path" => env('channel_icon_path',  'https://freshwork.connectify.co/assets/images/freshworks.png'),
    "details" => env('channel_details', "Forward fw-app data to your Freshworks."),
    "is_channel_account_editable" => env('channel_is_channel_account_editable', true),
    "custom_app_option" => env('channel_custom_app_option', true),
    "slug" => env('channel_slug', "quick-books-online"),

    "freshworks_sandbox_client_id" => env('FRESHWORKS_SANDBOX_CLIENT_ID', ""),
    "freshworks_sandbox_client_secret" => env('FRESHWORKS_SANDBOX_CLIENT_SECRET', ""),
    "freshworks_production_client_id" => env('FRESHWORKS_PRODUCTION_CLIENT_ID', ""),
    "freshworks_production_client_secret" => env('FRESHWORKS_PRODUCTION_CLIENT_SECRET', ""),
    "freshworks_oauth_callback" => env('FRESHWORKS_OAUTH_CALLBACK', ""),
    'freshworks_authorizationRequestUrl' => 'https://appcenter.intuit.com/connect/oauth2',
    'freshworks_tokenEndPointUrl' => 'https://oauth.platform.intuit.com/oauth2/v1/tokens/bearer',

    'freshworks_oauth_scope' => 'com.intuit.freshworks.accounting', //Example 'com.intuit.freshworks.accounting',
    'freshworks_openID_scope' => '', //Example 'openid profile email',
    'freshworks_oauth_redirect_uri' => env('FRESHWORKS_OAUTH_CALLBACK', ""),
    'openID_redirect_uri' => '',//Example 'https://d1eec721.ngrok.io/OAuth_2/OAuthOpenIDExample.php',
    'freshworks_mainPage' => '', //Example https://d1eec721.ngrok.io/OAuth_2/index.php',
    'freshworks_refreshTokenPage' => '',
    'freshworks_productionUrl' => 'https://freshworks.api.intuit.com',
    'freshworks_sandboxUrl' => 'https://sandbox-freshworks.api.intuit.com',
];
