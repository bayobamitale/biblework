<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;

class SearchByVerse extends Component
{
    public $bookByVerse;
    public $chapterByVerse;
    public $verseByVerse;
    public $bibleVersionByVerse;
    public $results;
    public $firstTitle;

    public function mount()
    {
        $this->bookByVerse = urldecode(session('bookByVerse') ?? request('bookByVerse'));
        $this->chapterByVerse = session('chapterByVerse') ?? request('chapterByVerse');
        $this->verseByVerse = session('verseByVerse') ?? request('verseByVerse');
        $this->bibleVersionByVerse = session('bibleVersionByVerse') ?? request('bibleVersionByVerse');
        $this->fetchResults();
    }

    public function fetchResults()
    {
        session(['bookByVerse' => $this->bookByVerse]);
        session(['chapterByVerse' => $this->chapterByVerse]);
        session(['verseByVerse' => $this->verseByVerse]);
        session(['bibleVersionByVerse' => $this->bibleVersionByVerse]);
        $versions = [
            'kjv' => 't_kjv',
            'asv' => 't_asv',
            'web' => 't_web',
            'ylt' => 't_ylt',
            'bbe' => 't_bbe',
        ];

        $versionTable = $versions[$this->bibleVersionByVerse] ?? 't_kjv';

        $this->results = DB::table($versionTable)
            ->join('book_info', $versionTable . '.b', '=', 'book_info.order')
            ->where('book_info.title_short', 'like', '%' . $this->bookByVerse . '%')
            ->where($versionTable . '.c', $this->chapterByVerse)
            ->where($versionTable . '.v', $this->verseByVerse)
            ->get();

        if ($this->results->count() > 0) {
            $this->firstTitle = $this->results->first()->title_short;
        }
    }

    public function render()
    {
        return view('livewire.search-by-verse')->layout('components.layouts.app');
    }
}
