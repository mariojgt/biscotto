<?php

use Illuminate\Support\Facades\Route;
use Mariojgt\Biscotto\Controllers\BiscottoContoller;

// Standard
Route::group([
    'middleware' => ['web']
], function () {
    // example page not required to be login
    Route::post('/biscotto/savecookie', [BiscottoContoller::class, 'index'])->name('biscotto.savecookie');
});
