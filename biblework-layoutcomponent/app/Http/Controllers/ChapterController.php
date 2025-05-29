<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChapterController extends Controller
{
    public function showChapter(Request $request)
    {
        $book = $request->input('book');
        $chapter = $request->input('chapter');
        $bibleVersion = $request->input('version');

        if (!$book) {
            // Handle error
            return redirect()->back()->withErrors(['Book is required']);
        }

        $version = $this->getVersionTable($bibleVersion);

        $title = DB::table($version)
            ->join('book_info', $version . '.b', '=', 'book_info.order')
            ->where('title_short', 'like', '%' . $book . '%')
            ->where('c', $chapter)
            ->value('title_short');

        $verses = DB::table($version)
            ->join('book_info', $version . '.b', '=', 'book_info.order')
            ->where('title_short', 'like', '%' . $book . '%')
            ->where('c', $chapter)
            ->get(['v', 't']);

        return view('components.chapter_results', compact('title', 'verses', 'chapter', 'bibleVersion'));
    }

    private function getVersionTable($version)
    {
        $versions = [
            'kjv' => 't_kjv',
            'asv' => 't_asv',
            'web' => 't_web',
            'ylt' => 't_ylt',
            'bbe' => 't_bbe',
        ];

        return $versions[$version] ?? 't_kjv';
    }
    
}
