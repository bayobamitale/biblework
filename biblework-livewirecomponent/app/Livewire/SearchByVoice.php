<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;

class SearchByVoice extends Component
{
    public $searchTextByVoice;
    public $bibleVersionByVoice;
    public $results;

    public function mount()
    {
        $this->searchTextByVoice =  request('searchTextByVoice') ?? session('searchTextByVoice');
        $this->bibleVersionByVoice = request('bibleVersionByVoice') ?? session('bibleVersionByVoice');
        $this->voiceResults();
    }

    public function voiceResults()
    {
        session(['searchTextByVoice' => $this->searchTextByVoice]);
        session(['bibleVersionByVoice' => $this->bibleVersionByVoice]);
        $versions = [
            'kjv' => 't_kjv',
            'asv' => 't_asv',
            'web' => 't_web',
            'ylt' => 't_ylt',
            'bbe' => 't_bbe',
        ];

        $versionTable = $versions[$this->bibleVersionByVoice] ?? 't_kjv';

        $this->results = DB::table($versionTable)
            ->join('book_info', $versionTable . '.b', '=', 'book_info.order')
            ->where($versionTable . '.t', 'like', '%' . $this->searchTextByVoice . '%')
            ->get();
    }

    public function render()
    {
        return view('livewire.search-by-voice')->layout('components.layouts.app');
    }
}
