<?php


use Livewire\Livewire;
use App\Livewire\SearchByCompare;
use Tests\TestCase;

it('that true is true', function () {
    expect(true)->toBeTrue();
});

it('sets book, chapter, verse, and versions from request', function () {
    $component = new SearchByCompare();
    request()->merge([
        'bookByCompare' => 'genesis',
        'chapterByCompare' => '1',
        'verseByCompare' => '1',
        'bibleVersion1' => 'kjv',
        'bibleVersion2' => 'asv',
    ]);
    $component->mount();
    expect($component->bookByCompare)->toBe('genesis');
    expect($component->chapterByCompare)->toBe('1');
    expect($component->verseByCompare)->toBe('1');
    expect($component->bibleVersion1)->toBe('kjv');
    expect($component->bibleVersion2)->toBe('asv');
});

it('sets book, chapter, verse, and versions from session', function () {
    session([
        'bookByCompare' => 'genesis',
        'chapterByCompare' => '1',
        'verseByCompare' => '1',
        'bibleVersion1' => 'kjv',
        'bibleVersion2' => 'asv',
    ]);
    $component = new SearchByCompare();
    $component->mount();
    expect($component->bookByCompare)->toBe('genesis');
    expect($component->chapterByCompare)->toBe('1');
    expect($component->verseByCompare)->toBe('1');
    expect($component->bibleVersion1)->toBe('kjv');
    expect($component->bibleVersion2)->toBe('asv');
});

it('url decodes book, chapter, verse, and versions from request', function () {
    $component = new SearchByCompare();
    request()->merge([
        'bookByCompare' => 'genesis%20creation',
        'chapterByCompare' => '1%20chapter',
        'verseByCompare' => '1%20verse',
        'bibleVersion1' => 'kjv%20version',
        'bibleVersion2' => 'asv%20version',
    ]);
    $component->mount();
    expect($component->bookByCompare)->toBe('genesis creation');
    expect($component->chapterByCompare)->toBe('1 chapter');
    expect($component->verseByCompare)->toBe('1 verse');
    expect($component->bibleVersion1)->toBe('kjv version');
    expect($component->bibleVersion2)->toBe('asv version');
});

it('searches versions with correct parameters', function () {
    $component = new SearchByCompare();
    $component->bookByCompare = 'genesis';
    $component->chapterByCompare = '1';
    $component->verseByCompare = '1';
    $component->bibleVersion1 = 'kjv';
    $component->bibleVersion2 = 'asv';
    $component->searchVersion();
    expect($component->results1)->not()->toBeEmpty();
    expect($component->results2)->not()->toBeEmpty();
});

it('stores book, chapter, verse, and versions in session', function () {
    $component = new SearchByCompare();
    $component->bookByCompare = 'genesis';
    $component->chapterByCompare = '1';
    $component->verseByCompare = '1';
    $component->bibleVersion1 = 'kjv';
    $component->bibleVersion2 = 'asv';
    $component->searchVersion();
    expect(session('bookByCompare'))->toBe('genesis');
    expect(session('chapterByCompare'))->toBe('1');
    expect(session('verseByCompare'))->toBe('1');
    expect(session('bibleVersion1'))->toBe('kjv');
    expect(session('bibleVersion2'))->toBe('asv');
});

it('uses default version if version is not set', function () {
    session(['bibleVersion1' => 'kjv']);
    session(['bibleVersion2' => 'kjv']);
    $component = new SearchByCompare();
    $component->mount();
    expect($component->bibleVersion1)->toBe('kjv');
    expect($component->bibleVersion2)->toBe('kjv');
});
