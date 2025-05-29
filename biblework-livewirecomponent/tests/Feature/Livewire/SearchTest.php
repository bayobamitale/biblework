<?php
use App\Livewire\Search;
use Livewire\Livewire;
use Tests\TestCase;


it('renders successfully', function () {
    Livewire::test(Search::class)
        ->assertStatus(200);
});

it('redirects to search results route', function () {
    Livewire::test(Search::class)
        ->set('searchTextByKeyword', 'sow')
        ->set('bibleVersionByKeyword', 'kjv')
        ->call('search')
        ->assertRedirect(route('searchResults', [
            'searchTextByKeyword' => 'sow',
            'bibleVersionByKeyword' => 'kjv',
        ]));
});

it('redirects to chapter results route', function () {
    Livewire::test(Search::class)
        ->set('bookByChapter', 'Genesis')
        ->set('chapterByChapter', 1)
        ->set('bibleVersionByChapter', 'kjv')
        ->call('chapter')
        ->assertRedirect(route('chapterResults', [
            'bookByChapter' => 'Genesis',
            'chapterByChapter' => 1,
            'bibleVersionByChapter' => 'kjv',
        ]));
});

it('redirects to verse results route', function () {
    Livewire::test(Search::class)
        ->set('bookByVerse', 'Genesis')
        ->set('chapterByVerse', 1)
        ->set('verseByVerse', 1)
        ->set('bibleVersionByVerse', 'kjv')
        ->call('verse')
        ->assertRedirect(route('verseResults', [
            'bookByVerse' => 'Genesis',
            'chapterByVerse' => 1,
            'verseByVerse' => 1,
            'bibleVersionByVerse' => 'kjv',
        ]));
});

it('redirects to version results route', function () {
    Livewire::test(Search::class)
        ->set('bookByCompare', 'Genesis')
        ->set('chapterByCompare', 1)
        ->set('verseByCompare', 1)
        ->set('bibleVersion1', 'kjv')
        ->set('bibleVersion2', 'asv')
        ->call('compare')
        ->assertRedirect(route('compareResults', [
            'bookByCompare' => 'Genesis',
            'chapterByCompare' => 1,
            'verseByCompare' => 1,
            'bibleVersion1' => 'kjv',
            'bibleVersion2' => 'asv',
        ]));
});

it('redirects to voice results route', function () {
    Livewire::test(Search::class)
        ->set('searchTextByVoice', 'sow')
        ->set('bibleVersionByVoice', 'kjv')
        ->call('voice')
        ->assertRedirect(route('voiceResults', [
            'searchTextByVoice' => 'sow',
            'bibleVersionByVoice' => 'kjv',
        ]));
});