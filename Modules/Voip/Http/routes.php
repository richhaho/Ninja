<?php

Route::group(['middleware' => ['web', 'lookup:user', 'auth:user'], 'namespace' => 'Modules\Voip\Http\Controllers'], function()
{
    Route::resource('voip', 'VoipController');
    Route::post('voip/bulk', 'VoipController@bulk');
    Route::get('api/voip', 'VoipController@datatable');
});

Route::group(['middleware' => 'api', 'namespace' => 'Modules\Voip\Http\ApiControllers', 'prefix' => 'api/v1'], function()
{
    Route::resource('voip', 'VoipApiController');
});
