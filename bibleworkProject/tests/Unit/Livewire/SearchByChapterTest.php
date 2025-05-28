<?php


use Livewire\Livewire;
use App\Livewire\SearchByChapter;
use Tests\TestCase;

it('that true is true', function () {
    expect(true)->toBeTrue();
});

it('sets book, chapter, and version from request', function () {
    $component = new SearchByChapter();
    request()->merge([
        'bookByChapter' => 'genesis',
        'chapterByChapter' => '1',
        'bibleVersionByChapter' => 'kjv',
    ]);
    $component->mount();
    expect($component->bookByChapter)->toBe('genesis');
    expect($component->chapterByChapter)->toBe('1');
    expect($component->bibleVersionByChapter)->toBe('kjv');
});

it('sets book, chapter, and version from session', function () {
    session([
        'bookByChapter' => 'genesis',
        'chapterByChapter' => '1',
        'bibleVersionByChapter' => 'kjv',
    ]);
    $component = new SearchByChapter();
    $component->mount();
    expect($component->bookByChapter)->toBe('genesis');
    expect($component->chapterByChapter)->toBe('1');
    expect($component->bibleVersionByChapter)->toBe('kjv');
});

it('url decodes book from request', function () {
    $component = new SearchByChapter();
    request()->merge([
        'bookByChapter' => 'genesis%20creation',
    ]);
    $component->mount();
    expect($component->bookByChapter)->toBe('genesis creation');
});

it('searches chapter with correct parameters', function () {
    $component = new SearchByChapter();
    $component->bookByChapter = 'genesis';
    $component->chapterByChapter = '1';
    $component->bibleVersionByChapter = 'kjv';
    $component->searchChapter();
    expect($component->results)->not()->toBeEmpty();
});


it('stores book, chapter, and version in session', function () {
    $component = new SearchByChapter();
    $component->bookByChapter = 'genesis';
    $component->chapterByChapter = '1';
    $component->bibleVersionByChapter = 'kjv';
    $component->searchChapter();
    expect(session('bookByChapter'))->toBe('genesis');
    expect(session('chapterByChapter'))->toBe('1');
    expect(session('bibleVersionByChapter'))->toBe('kjv');
});

it('uses default version if version is not set', function () {
    session(['bibleVersionByChapter' => 'kjv']);
    $component = new SearchByChapter();
    $component->mount();
    expect($component->bibleVersionByChapter)->toBe('kjv');
});