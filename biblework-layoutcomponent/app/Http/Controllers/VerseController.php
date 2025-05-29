<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class VerseController extends Controller
{
    public function showVerse(Request $request)
    {
        $book = $request->input('book');
        $chapter = $request->input('chapter');
        $verse = $request->input('verse');
        $bibleVersion = $request->input('version');

        if (!$book) {
            // Handle error
            return redirect()->back()->withErrors(['Book is required']);
        }

        $versionTable = $this->getVersionTable($bibleVersion);

        $verses = DB::table($versionTable)
            ->join('book_info', $versionTable . '.b', '=', 'book_info.order')
            ->where('title_short', 'like', '%' . $book . '%')
            ->where('c', $chapter)
            ->where('v', $verse)
            ->get();

        $bookTitle = DB::table($versionTable)
            ->join('book_info', $versionTable . '.b', '=', 'book_info.order')
            ->where('title_short', 'like', '%' . $book . '%')
            ->where('c', $chapter)
            ->where('v', $verse)
            ->first()->title_short ?? 'Unknown Book';

        return view('components.verse', [
            'bookTitle' => $bookTitle,
            'chapter' => $chapter,
            'verse' => $verse,
            'bibleVersion' => $bibleVersion,
            'verses' => $verses,
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
