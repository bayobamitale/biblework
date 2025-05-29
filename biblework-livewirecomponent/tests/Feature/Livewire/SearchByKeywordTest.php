<?php
//namespace Tests\Feature;
use App\Livewire\SearchByKeyword;
use Livewire\Livewire;
use Tests\TestCase;

it('renders successfully', function () {
    Livewire::test(SearchByKeyword::class)
        ->assertStatus(200);
});

it('sets properties correctly in mount', function () {
    $searchText = 'sow';
    $version = 'kjv';

    Livewire::withQueryParams([
        'searchTextByKeyword' => $searchText,
        'bibleVersionByKeyword' => $version,
    ])->test(SearchByKeyword::class)
        ->assertSet('searchTextByKeyword', $searchText)
        ->assertSet('bibleVersionByKeyword', $version);
});

it('retrieves correct results', function () {
    $searchText = 'sow';
    $version = 'kjv';

    $component = Livewire::withQueryParams([
        'searchTextByKeyword' => $searchText,
        'bibleVersionByKeyword' => $version,
    ])->test(SearchByKeyword::class);

    expect($component->results)->not()->toBeEmpty();
});

it('handles empty search text', function () {
    $searchText = 'dsafdsfsdafsadfsdafsadfsdf';
    $version = 'kjv';

    $component = Livewire::withQueryParams([
        'searchTextByKeyword' => $searchText,
        'bibleVersionByKeyword' => $version,
    ])->test(SearchByKeyword::class);

    expect($component->results)->toHaveCount(0);
});

it('stores search text and version in session', function () {
    $searchText = 'sow';
    $version = 'kjv';
    Livewire::withQueryParams([
        'searchTextByKeyword' => $searchText,
        'bibleVersionByKeyword' => $version,
    ])->test(SearchByKeyword::class);
    expect(session('searchTextByKeyword'))->toBe($searchText);
    expect(session('bibleVersionByKeyword'))->tobe($version);
});

it('uses default version if version is not provided', function () {
    $searchText = 'sow';
    $component = Livewire::withQueryParams([
        'searchTextByKeyword' => $searchText,
    ])->test(SearchByKeyword::class);
    expect($component->bibleVersionByKeyword)->toBe(null);
});

