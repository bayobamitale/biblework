<?php
use App\Livewire\SearchByVoice;
use Livewire\Livewire;
use Tests\TestCase;

it('renders successfully', function () {
    Livewire::test(SearchByVoice::class)
        ->assertStatus(200);
});

it('sets properties correctly in mount', function () {
    $searchText = 'love';
    $version = 'kjv';

    Livewire::withQueryParams([
        'searchTextByVoice' => $searchText,
        'bibleVersionByVoice' => $version,
    ])->test(SearchByVoice::class)
        ->assertSet('searchTextByVoice', $searchText)
        ->assertSet('bibleVersionByVoice', $version);
});

it('retrieves correct results', function () {
    $searchText = 'love';
    $version = 'kjv';

    $component = Livewire::withQueryParams([
        'searchTextByVoice' => $searchText,
        'bibleVersionByVoice' => $version,
    ])->test(SearchByVoice::class);

    expect($component->results)->not()->toBeEmpty();
});

it('handles empty search text', function () {
    $searchText = 'dsafdsfsdafsadfsdafsadfsdf';
    $version = 'kjv';

    $component = Livewire::withQueryParams([
        'searchTextByVoice' => $searchText,
        'bibleVersionByVoice' => $version,
    ])->test(SearchByVoice::class);

    expect($component->results)->toHaveCount(0);
});
