<?php

use App\Http\Controllers\PollController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

Route::apiResource('polls', PollController::class);
Route::post('polls/{poll}/vote', [VoteController::class, 'store']);
Route::get('polls/{poll}/results', [VoteController::class, 'results']);