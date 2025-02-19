<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivreController;

Route::resource('livres', LivreController::class);