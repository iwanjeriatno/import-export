<?php

Route::prefix('table')->group(function () {
    Route::get('export/{type}', 'TableController@export')->name('table.export');
});
