<?php

Route::group([ 'namespace' => 'CraigWoodlandOW\LaravelBarcodeGenerator', 'middleware' => [ 'web' ], 'prefix' => 'vendor/barcode' ], function () {
    Route::get('/{type}/{value}.png', 'BarcodeController@show');
});
