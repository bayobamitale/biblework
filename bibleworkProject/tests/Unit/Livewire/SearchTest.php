<?php

use App\Livewire\Search;
use Livewire\Livewire;
use Tests\TestCase;


it('that true is true', function (){
    expect(true)->toBeTrue();
});

it('search method returns correct redirect url', function (){
    $searchTextByKeyword = 'sow';
        $bibleVersionByKeyword = 'kjv';

        $expectedUrl = '/search?' . http_build_query([
            'searchTextByKeyword' => $searchTextByKeyword,
            'bibleVersionByKeyword' => $bibleVersionByKeyword,
        ]);

        Livewire::test(Search::class)
            ->set('searchTextByKeyword', $searchTextByKeyword)
            ->set('bibleVersionByKeyword', $bibleVersionByKeyword)
            ->call('search')
            ->assertRedirect($expectedUrl);
});

it('chapter method returns correct redirect url', function()  {
    $bookByChapter = 'Genesis';
    $chapterByChapter = '1';
    $bibleVersionByChapter = 'KJV';
    $expectedUrl = '/chapter?' . http_build_query([
        'bookByChapter' => $bookByChapter,
        'chapterByChapter' => $chapterByChapter, 
        'bibleVersionByChapter' => $bibleVersionByChapter,
    ]);
    Livewire::test(Search::class)
        ->set('bookByChapter', $bookByChapter )
        ->set('chapterByChapter', $chapterByChapter)
        ->set('bibleVersionByChapter', $bibleVersionByChapter)
        ->call('chapter')
        ->assertRedirect($expectedUrl);
});

it('verse method returns correct redirect url', function(){
    $bookByVerse = 'Genesis';
    $chapterByVerse = '1';
    $verseByVerse = '1';
    $bibleVersionByVerse = 'KJV';

    $expectedUrl = '/verse?' . http_build_query([
        'bookByVerse' => $bookByVerse,
        'chapterByVerse' => $chapterByVerse, 
        'verseByVerse' => $chapterByVerse,
        'bibleVersionByVerse' => $bibleVersionByVerse,
    ]);
    Livewire::test(Search::class)
        ->set('bookByVerse', $bookByVerse)
        ->set('chapterByVerse', $chapterByVerse)
        ->set('verseByVerse', $verseByVerse)
        ->set('bibleVersionByVerse', $bibleVersionByVerse)
        ->call('verse')
        ->assertRedirect($expectedUrl);

});
it('search compare method returns correct redirect url', function(){
    $bookByCompare = 'Genesis';
    $chapterByCompare = '1';
    $verseByCompare = '1';
    $bibleVersion1 = 'KJV';
    $bibleVersion2 = 'ASV';

    $expectedUrl = '/compare?' . http_build_query([
        'bookByCompare' => $bookByCompare,
        'chapterByCompare' => $chapterByCompare, 
        'verseByCompare' => $chapterByCompare,
        'bibleVersion1' => $bibleVersion1,
        'bibleVersion2' => $bibleVersion2,
    ]);
    Livewire::test(Search::class)
        ->set('bookByCompare', $bookByCompare)
        ->set('chapterByCompare', $chapterByCompare)
        ->set('verseByCompare', $verseByCompare)
        ->set('bibleVersion1', $bibleVersion1)
        ->set('bibleVersion2', $bibleVersion2)
        ->call('compare')
        ->assertRedirect($expectedUrl);
});

it('search voice method returns correct redirect url', function(){
    $searchTextByVoice = 'sow';
    $bibleVersionByVoice = 'kjv';

    $expectedUrl = '/voice?' . http_build_query([
        'searchTextByVoice' => $searchTextByVoice,
        'bibleVersionByVoice' => $bibleVersionByVoice, 
    ]);
    Livewire::test(Search::class)
        ->set('searchTextByVoice', $searchTextByVoice)
        ->set('bibleVersionByVoice', $bibleVersionByVoice)
        ->call('voice')
        ->assertRedirect($expectedUrl);
});