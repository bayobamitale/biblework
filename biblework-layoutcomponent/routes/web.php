<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BibleController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\VerseController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\VoiceController;


Route::get('/', function () {
    return view('index');
});


Route::post('/search', [BibleController::class, 'search'])->name('search');

Route::post('/chapter', [ChapterController::class, 'showChapter'])->name('showChapter');

Route::post('/verse', [VerseController::class, 'showVerse'])->name('showVerse');

Route::post('/compare', [CompareController::class, 'compare'])->name('compare');

Route::post('/voice', [VoiceController::class, 'voice'])->name('voice');