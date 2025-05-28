<?php

namespace App\Livewire;
ini_set('memory_limit','256M');
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;

class SearchByKeyword extends Component
{
    public $searchTextByKeyword;
    public $bibleVersionByKeyword;
    public $results;

    public function mount()
    {
        $this->searchTextByKeyword = request('searchTextByKeyword') ?? session('searchTextByKeyword');
        $this->bibleVersionByKeyword = request('bibleVersionByKeyword') ?? session('bibleVersionByKeyword');
        $this->searchResults();
    }

    public function searchResults()
    {
        session(['searchTextByKeyword' => $this->searchTextByKeyword]);
        session(['bibleVersionByKeyword' => $this->bibleVersionByKeyword]);
        // Fetch results logic here
        $versions = [
            'kjv' => 't_kjv',
            'asv' => 't_asv',
            'web' => 't_web',
            'ylt' => 't_ylt',
            'bbe' => 't_bbe',
        ];
        $versionTable = $versions[$this->bibleVersionByKeyword] ?? 't_kjv';
        $this->results = DB::table($versionTable)
            ->join('book_info', $versionTable . '.b', '=', 'book_info.order')
            ->where($versionTable . '.t', 'like', '%' . $this->searchTextByKeyword . '%')
            ->get();
    }
    public function render()
    {
        return view('livewire.search-by-keyword')->layout('components.layouts.app');
    }
}
