<?php


use Livewire\Livewire;
use App\Livewire\SearchByVerse;
use Tests\TestCase;

it('that true is true', function () {
    expect(true)->toBeTrue();
});

it('sets book, chapter, verse, and version from request', function () {
    $component = new SearchByVerse();
    request()->merge([
        'bookByVerse' => 'genesis',
        'chapterByVerse' => '1',
        'verseByVerse' => '1',
        'bibleVersionByVerse' => 'kjv',
    ]);
    $component->mount();
    expect($component->bookByVerse)->toBe('genesis');
    expect($component->chapterByVerse)->toBe('1');
    expect($component->verseByVerse)->toBe('1');
    expect($component->bibleVersionByVerse)->toBe('kjv');
});

it('sets book, chapter, verse, and version from session', function () {
    session([
        'bookByVerse' => 'genesis',
        'chapterByVerse' => '1',
        'verseByVerse' => '1',
        'bibleVersionByVerse' => 'kjv',
    ]);
    $component = new SearchByVerse();
    $component->mount();
    expect($component->bookByVerse)->toBe('genesis');
    expect($component->chapterByVerse)->toBe('1');
    expect($component->verseByVerse)->toBe('1');
    expect($component->bibleVersionByVerse)->toBe('kjv');
});

it('url decodes book from request', function () {
    $component = new SearchByVerse();
    request()->merge([
        'bookByVerse' => 'genesis%20creation',
    ]);
    $component->mount();
    expect($component->bookByVerse)->toBe('genesis creation');
});

it('fetches results with correct parameters', function () {
    $component = new SearchByVerse();
    $component->bookByVerse = 'genesis';
    $component->chapterByVerse = '1';
    $component->verseByVerse = '1';
    $component->bibleVersionByVerse = 'kjv';
    $component->fetchResults();
    expect($component->results)->not()->toBeEmpty();
});

it('stores book, chapter, verse, and version in session', function () {
    $component = new SearchByVerse();
    $component->bookByVerse = 'genesis';
    $component->chapterByVerse = '1';
    $component->verseByVerse = '1';
    $component->bibleVersionByVerse = 'kjv';
    $component->fetchResults();
    expect(session('bookByVerse'))->toBe('genesis');
    expect(session('chapterByVerse'))->toBe('1');
    expect(session('verseByVerse'))->toBe('1');
    expect(session('bibleVersionByVerse'))->toBe('kjv');
});

it('uses default version if version is not set', function () {
    session(['bibleVersionByVerse' => 'kjv']);
    $component = new SearchByVerse();
    $component->mount();
    expect($component->bibleVersionByVerse)->toBe('kjv');
});