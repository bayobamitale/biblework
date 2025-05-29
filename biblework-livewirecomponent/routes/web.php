<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Search;
use App\Livewire\SearchByKeyword;
use App\Livewire\SearchByChapter;
use App\Livewire\SearchByVerse;
use App\Livewire\SearchByCompare;
use App\Livewire\SearchByVoice;


Route::get('/', Search::class)->name('search');

Route::get('/search', SearchByKeyword::class)->name('searchResults');

Route::get('/chapter', SearchByChapter::class)->name('chapterResults');

Route::get('/verse', SearchByVerse::class)->name('verseResults');

Route::get('/compare', SearchByCompare::class)->name('compareResults');

Route::get('/voice', SearchByVoice::class)->name('voiceResults');




