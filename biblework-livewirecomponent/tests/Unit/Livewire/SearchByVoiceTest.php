<?php


use Livewire\Livewire;
use App\Livewire\SearchByVoice;
use Tests\TestCase;

it('that true is true', function () {
    expect(true)->toBeTrue();
});

it('sets search text and version from request', function () {
    $component = new SearchByVoice();
    request()->merge([
        'searchTextByVoice' => 'Jesus',
        'bibleVersionByVoice' => 'kjv',
    ]);
    $component->mount();
    expect($component->searchTextByVoice)->toBe('Jesus');
    expect($component->bibleVersionByVoice)->toBe('kjv');
});

it('sets search text and version from session', function () {
    session([
        'searchTextByVoice' => 'Jesus',
        'bibleVersionByVoice' => 'kjv',
    ]);
    $component = new SearchByVoice();
    $component->mount();
    expect($component->searchTextByVoice)->toBe('Jesus');
    expect($component->bibleVersionByVoice)->toBe('kjv');
});

it('searches voice results with correct parameters', function () {
    $component = new SearchByVoice();
    $component->searchTextByVoice = 'Jesus';
    $component->bibleVersionByVoice = 'kjv';
    $component->voiceResults();
    expect($component->results)->not()->toBeEmpty();
});

it('stores search text and version in session', function () {
    $component = new SearchByVoice();
    $component->searchTextByVoice = 'Jesus';
    $component->bibleVersionByVoice = 'kjv';
    $component->voiceResults();
    expect(session('searchTextByVoice'))->toBe('Jesus');
    expect(session('bibleVersionByVoice'))->toBe('kjv');
});

it('uses default version if version is not set', function () {
    session(['bibleVersionByVoice' => 'kjv']);
    $component = new SearchByVoice();
    $component->mount();
    expect($component->bibleVersionByVoice)->toBe('kjv');
});
