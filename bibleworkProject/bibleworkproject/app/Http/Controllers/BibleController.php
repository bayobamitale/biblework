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

        // Validate input
        if (empty($searchText)) {
            return 'Search Text is required';
        }

        // Determine Bible version
        $versions = [
            'kjv' => 't_kjv',
            'asv' => 't_asv',
            'ylt' => 't_ylt',
            'web' => 't_web',
            'bbe' => 't_bbe',
        ];
        
        $version = $versions[$bibleVersion] ?? 't_kjv';

        // Perform database query
        $results = DB::table($version)
            ->join('book_info', 'book_info.order', '=', $version . '.b')
            ->where('t', 'LIKE', '%' . $searchText . '%')
            ->get();

        // Render results
        return view('search_results', [
            'searchText' => $searchText,
            'results' => $results,
        ]);
    }

}
