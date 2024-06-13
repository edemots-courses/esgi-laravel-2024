<?php

use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('tags', TagController::class)->scoped([
        'tag' => 'slug'
    ]);
});
