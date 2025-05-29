<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class Search extends Component
{
    public $searchTextByKeyword;
    public $bibleVersionByKeyword;

    public $bookByChapter;
    public $chapterByChapter;
    public $bibleVersionByChapter;

    public $bookByVerse;
    public $chapterByVerse;
    public $verseByVerse;
    public $bibleVersionByVerse;

    public $bookByCompare;
    public $chapterByCompare;
    public $verseByCompare;
    
    public $bibleVersion1;
    public $bibleVersion2;
    public $searchTextByVoice;
    public $bibleVersionByVoice;
    
    public function search()
    {
        return redirect()->route('searchResults', [
            'searchTextByKeyword' => $this->searchTextByKeyword,
            'bibleVersionByKeyword' => $this->bibleVersionByKeyword,
        ]);
    }

    public function chapter()
    {
        return redirect()->route('chapterResults', [
            'bookByChapter' => $this->bookByChapter,
            'chapterByChapter' => $this->chapterByChapter,
            'bibleVersionByChapter' => $this->bibleVersionByChapter,
        ]);
    }

    public function verse()
    {
        return redirect()->route('verseResults', [
            'bookByVerse' => $this->bookByVerse,
            'chapterByVerse' => $this->chapterByVerse,
            'verseByVerse' => $this->verseByVerse,
            'bibleVersionByVerse' => $this->bibleVersionByVerse,
        ]);
    }

    public function compare()
    {
        return redirect()->route('compareResults', [
            'bookByCompare' => $this->bookByCompare,
            'chapterByCompare' => $this->chapterByCompare,
            'verseByCompare' => $this->verseByCompare,
            'bibleVersion1' => $this->bibleVersion1,
            'bibleVersion2' => $this->bibleVersion2,
        ]);
    }

    public function voice()
    {
        return redirect()->route('voiceResults', [
            'searchTextByVoice' => $this->searchTextByVoice,
            'bibleVersionByVoice' => $this->bibleVersionByVoice,
        ]);
    }

   

    public function render()
    {
        return view('livewire.search')->layout('components.layouts.app');
    }
}
