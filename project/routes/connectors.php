<?php

// auth routes
Route::group(['middleware' => 'web','ShopAuth'], function () {
    //Freshworks connector routes
    Route::post('store/app/freshworks_online', 'FreshworksEventsManagementController@store_freshworks_online_app_account')
        ->name('store_freshworks_online_app_account');
    Route::get('app/freshworks_online', 'FreshworksEventsManagementController@freshworks_online_app_account')
        ->name('freshworks_online_app_account');

    Route::any('freshworks_online/login/', 'FreshworksEventsManagementController@freshworks_account_login')
        ->name('freshworks_online_account_login');
    Route::get('freshworks_callback', 'FreshworksEventsManagementController@freshworks_callback')->name('freshworks_callback');

    Route::post('remove_freshworks_account', 'FreshworksEventsManagementController@remove_freshworks_account')
        ->name('remove_freshworks_account');
    Route::post('store_freshworks_event/', 'FreshworksEventsManagementController@store_freshworks_event')
        ->name('store_freshworks_event')->middleware('CheckWebhooksLimit');


    Route::post('update_freshworks_event/{id}', 'FreshworksEventsManagementController@update_freshworks_event')
        ->name('update_freshworks_event')
        ->middleware('CheckWebhooksLimit');
    Route::get('load_freshworks_object_fields', 'FreshworksEventsManagementController@load_freshworks_object_fields')
        ->name('load_freshworks_object_fields');
    Route::get('load_freshworks_fields_section', 'FreshworksEventsManagementController@load_freshworks_fields_section')
        ->name('load_freshworks_fields_section');
    Route::get('get_freshworks_resources', 'FreshworksEventsManagementController@get_freshworks_resources')
        ->name('get_freshworks_resources');

});