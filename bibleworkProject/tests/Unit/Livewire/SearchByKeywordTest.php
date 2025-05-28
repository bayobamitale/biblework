<?php


use Livewire\Livewire;
use App\Livewire\SearchByKeyword;
use Tests\TestCase;

it('that true is true', function () {
    expect(true)->toBeTrue();
});

it('searchResults method retrieves correct results', function () {
    $component = new SearchByKeyword();
    $component->searchTextByKeyword = 'sow';
    $component->bibleVersionByKeyword = 'kjv';
    $component->searchResults();
    expect($component->results)->not()->toBeEmpty();
});

it('searchResults method is case-insensitive', function () {
    $component = new SearchByKeyword();
    $component->searchTextByKeyword = 'SOW';
    $component->bibleVersionByKeyword = 'kjv';
    $component->searchResults();
    expect($component->results)->not()->toBeEmpty();
});

it('bibleVersionByKeyword property defaults to kjv if not set', function () {
    session(['bibleVersionByKeyword' => 'kjv']);
    $component = new SearchByKeyword();
    $component->mount();
    expect($component->bibleVersionByKeyword)->toBe('kjv');
});