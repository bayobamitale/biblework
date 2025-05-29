<?php
use App\Livewire\SearchByVerse;
use Livewire\Livewire;
use Tests\TestCase;

it('renders successfully', function () {
    Livewire::test(SearchByVerse::class)
        ->assertStatus(200);
});

it('sets properties correctly in mount', function () {
    $book = 'Genesis';
    $chapter = 1;
    $verse = 1;
    $version = 'kjv';

    Livewire::withQueryParams([
        'bookByVerse' => $book,
        'chapterByVerse' => $chapter,
        'verseByVerse' => $verse,
        'bibleVersionByVerse' => $version,
    ])->test(SearchByVerse::class)
        ->assertSet('bookByVerse', $book)
        ->assertSet('chapterByVerse', $chapter)
        ->assertSet('verseByVerse', $verse)
        ->assertSet('bibleVersionByVerse', $version);
});

it('retrieves correct results', function () {
    $book = 'Genesis';
    $chapter = 1;
    $verse = 1;
    $version = 'kjv';

    $component = Livewire::withQueryParams([
        'bookByVerse' => $book,
        'chapterByVerse' => $chapter,
        'verseByVerse' => $verse,
        'bibleVersionByVerse' => $version,
    ])->test(SearchByVerse::class);

    expect($component->results)->not()->toBeEmpty();
});

it('handles invalid book or chapter inputs', function () {
    $book = 'Invalid Book';
    $chapter = 999;
    $verse = 999;
    $version = 'kjv';

    $component = Livewire::withQueryParams([
        'bookByVerse' => $book,
        'chapterByVerse' => $chapter,
        'verseByVerse' => $verse,
        'bibleVersionByVerse' => $version,
    ])->test(SearchByVerse::class);

    expect($component->results)->toHaveCount(0);
});