<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;

class SearchByChapter extends Component
{
    public $bookByChapter;
    public $chapterByChapter;
    public $bibleVersionByChapter;
    public $results;
    public $firstTitle;

    public function mount()
    {
        $this->bookByChapter = urldecode(session('bookByChapter') ?? request('bookByChapter'));
        $this->chapterByChapter = session('chapterByChapter') ?? request('chapterByChapter');
        $this->bibleVersionByChapter = session('bibleVersionByChapter') ?? request('bibleVersionByChapter');
        $this->searchChapter();
    }

    public function searchChapter()
    {
        session(['bookByChapter' => $this->bookByChapter]);
        session(['chapterByChapter' => $this->chapterByChapter]);
        session(['bibleVersionByChapter' => $this->bibleVersionByChapter]);
        $versions = [
            'kjv' => 't_kjv',
            'asv' => 't_asv',
            'web' => 't_web',
            'ylt' => 't_ylt',
            'bbe' => 't_bbe',
        ];

        $versionTable = $versions[$this->bibleVersionByChapter] ?? 't_kjv';

        $this->results = DB::table($versionTable)
            ->join('book_info', $versionTable . '.b', '=', 'book_info.order')
            ->where('book_info.title_short', 'like', '%' . $this->bookByChapter . '%')
            ->where($versionTable . '.c', $this->chapterByChapter)
            ->get();

        if ($this->results->count() > 0) {
            $this->firstTitle = $this->results->first()->title_short;
        }
    }

    
    public function render()
    {
        return view('livewire.search-by-chapter')->layout('components.layouts.app');
    }
}
