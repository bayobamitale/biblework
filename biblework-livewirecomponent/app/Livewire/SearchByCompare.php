<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;

class SearchByCompare extends Component
{
    public $bookByCompare;
    public $chapterByCompare;
    public $verseByCompare;
    public $bibleVersion1;
    public $bibleVersion2;
    public $results1;
    public $results2;
    public $firstTitle;

    public function mount()
    {
        $this->bookByCompare = urldecode(request('bookByCompare') ?? session('bookByCompare'));
        $this->chapterByCompare = urldecode(request('chapterByCompare') ?? session('chapterByCompare'));
        $this->verseByCompare = urldecode(request('verseByCompare') ?? session('verseByCompare'));
        $this->bibleVersion1 = urldecode(request('bibleVersion1') ?? session('bibleVersion1'));
        $this->bibleVersion2 = urldecode(request('bibleVersion2') ?? session('bibleVersion2'));
        $this->searchVersion();
    }
    public function getResults($versionTable)
    {
        return DB::table($versionTable)
            ->join('book_info', $versionTable . '.b', '=', 'book_info.order')
            ->where('book_info.title_short', 'like', '%' . $this->bookByCompare . '%')
            ->where($versionTable . '.c', $this->chapterByCompare)
            ->where($versionTable . '.v', $this->verseByCompare)
            ->get();
    }
    public function searchVersion()
    {
        session(['bookByCompare' => $this->bookByCompare]);
        session(['chapterByCompare' => $this->chapterByCompare]);
        session(['verseByCompare' => $this->verseByCompare]);
        session(['bibleVersion1' => $this->bibleVersion1]);
        session(['bibleVersion2' => $this->bibleVersion2]);

        $versions = [
            'kjv' => 't_kjv',
            'asv' => 't_asv',
            'web' => 't_web',
            'ylt' => 't_ylt',
            'bbe' => 't_bbe',
        ];
       

        $versionTable1 = $versions[$this->bibleVersion1] ?? 't_kjv';
        $versionTable2 = $versions[$this->bibleVersion2] ?? 't_kjv';

        $this->results1 = $this->getResults($versionTable1);

        $this->results2 = $this->getResults($versionTable2);

        if ($this->results1->count() > 0) {
            $this->firstTitle = $this->results1->first()->title_short;
        }
        if ($this->results2->count() > 0) {
            $this->secondTitle = $this->results2->first()->title_short;
        }
    }

    public function render()
    {
        return view('livewire.search-by-compare')->layout('components.layouts.app');
    }
}
