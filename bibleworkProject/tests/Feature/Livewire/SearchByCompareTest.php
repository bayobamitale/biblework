<?php
use App\Livewire\SearchByCompare;
use Livewire\Livewire;
use Tests\TestCase;

it('renders successfully', function () {
    Livewire::test(SearchByCompare::class)
        ->assertStatus(200);
});

it('sets properties correctly in mount', function () {
    $book = 'Genesis';
    $chapter = 1;
    $verse = 1;
    $version1 = 'kjv';
    $version2 = 'asv';

    Livewire::withQueryParams([
        'bookByCompare' => $book,
        'chapterByCompare' => $chapter,
        'verseByCompare' => $verse,
        'bibleVersion1' => $version1,
        'bibleVersion2' => $version2,
    ])->test(SearchByCompare::class)
        ->assertSet('bookByCompare', $book)
        ->assertSet('chapterByCompare', $chapter)
        ->assertSet('verseByCompare', $verse)
        ->assertSet('bibleVersion1', $version1)
        ->assertSet('bibleVersion2', $version2);
});

it('retrieves correct results', function () {
    $book = 'Genesis';
    $chapter = 1;
    $verse = 1;
    $version1 = 'kjv';
    $version2 = 'asv';

    $component = Livewire::withQueryParams([
        'bookByCompare' => $book,
        'chapterByCompare' => $chapter,
        'verseByCompare' => $verse,
        'bibleVersion1' => $version1,
        'bibleVersion2' => $version2,
    ])->test(SearchByCompare::class);

    expect($component->results1)->not()->toBeEmpty();
    expect($component->results2)->not()->toBeEmpty();
});

it('handles invalid book or chapter inputs', function () {
    $book = 'Invalid Book';
    $chapter = 999;
    $verse = 999;
    $version1 = 'kjv';
    $version2 = 'asv';

    $component = Livewire::withQueryParams([
        'bookByCompare' => $book,
        'chapterByCompare' => $chapter,
        'verseByCompare' => $verse,
        'bibleVersion1' => $version1,
        'bibleVersion2' => $version2,
    ])->test(SearchByCompare::class);

    expect($component->results1)->toBeEmpty();
    expect($component->results2)->toBeEmpty();
});