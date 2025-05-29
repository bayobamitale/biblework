<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BibleController extends Controller
{
    public function search(Request $request)
    {
        $searchText = $request->input('term');
        $bibleVersion = $request->input('version');

        if (empty($searchText)) {
            return redirect()->back()->withErrors(['text is required']);
        }

        $versionTable = $this->getVersionTable($bibleVersion);

        $results = DB::table($versionTable)
            ->join('book_info', $versionTable . '.b', '=', 'book_info.order')
            ->where('t', 'like', '%' . $searchText . '%')
            ->get();

        return view('components.search', [
            'searchText' => $searchText,
            'bibleVersion' => $bibleVersion,
            'results' => $results,
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
