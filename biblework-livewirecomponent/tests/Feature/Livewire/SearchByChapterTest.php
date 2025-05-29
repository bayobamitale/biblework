<?php

use App\Livewire\SearchByChapter;
use Livewire\Livewire;
use Tests\TestCase;

it('renders successfully', function () {
    Livewire::test(SearchByChapter::class)
        ->assertStatus(200);
});

it('sets properties correctly in mount', function () {
    $book = 'Genesis';
    $chapter = 1;
    $version = 'kjv';

    Livewire::withQueryParams([
        'bookByChapter' => $book,
        'chapterByChapter' => $chapter,
        'bibleVersionByChapter' => $version,
    ])->test(SearchByChapter::class)
        ->assertSet('bookByChapter', $book)
        ->assertSet('chapterByChapter', $chapter)
        ->assertSet('bibleVersionByChapter', $version);
});

it('retrieves correct results', function () {
    $book = 'Genesis';
    $chapter = 1;
    $version = 'kjv';

    $component = Livewire::withQueryParams([
        'bookByChapter' => $book,
        'chapterByChapter' => $chapter,
        'bibleVersionByChapter' => $version,
    ])->test(SearchByChapter::class);

    expect($component->results)->not()->toBeEmpty();
});


it('handles invalid book or chapter inputs', function () {
    $book = 'Invalid Book';
    $chapter = 999;
    $version = 'kjv';

    $component = Livewire::withQueryParams([
        'bookByChapter' => $book,
        'chapterByChapter' => $chapter,
        'bibleVersionByChapter' => $version,
    ])->test(SearchByChapter::class);

    expect($component->results)->toBeEmpty();
});