<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompareController extends Controller
{
    public function compare(Request $request)
    {
        $book = $request->input('book');
        $chapter = $request->input('chapter');
        $verse = $request->input('verse');
        $bibleVersion1 = $request->input('version1');
        $bibleVersion2 = $request->input('version2');

        if (!$book) {
            // Handle error
            return redirect()->back()->withErrors(['Book is required']);
        }

        $versionTable1 = $this->getVersionTable($bibleVersion1);
        $versionTable2 = $this->getVersionTable($bibleVersion2);

        $verses1 = DB::table($versionTable1)
            ->join('book_info', $versionTable1 . '.b', '=', 'book_info.order')
            ->where('title_short', 'like', '%' . $book . '%')
            ->where('c', $chapter)
            ->where('v', $verse)
            ->get();

        $verses2 = DB::table($versionTable2)
            ->join('book_info', $versionTable2 . '.b', '=', 'book_info.order')
            ->where('title_short', 'like', '%' . $book . '%')
            ->where('c', $chapter)
            ->where('v', $verse)
            ->get();

        $bookTitle = DB::table($versionTable1)
            ->join('book_info', $versionTable1 . '.b', '=', 'book_info.order')
            ->where('title_short', 'like', '%' . $book . '%')
            ->where('c', $chapter)
            ->where('v', $verse)
            ->first()->title_short ?? 'Unknown Book';

        return view('components.compare', [
            'bookTitle' => $bookTitle,
            'chapter' => $chapter,
            'verse' => $verse,
            'bibleVersion1' => $bibleVersion1,
            'bibleVersion2' => $bibleVersion2,
            'verses1' => $verses1,
            'verses2' => $verses2,
        ]);
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
