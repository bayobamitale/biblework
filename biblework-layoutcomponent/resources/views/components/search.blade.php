<x-layout_search>
    @if($searchText)
        <br />
        <hr />
        Version: {{ $bibleVersion }}
        <h1>Keyword: {{ $searchText }}</h1>
        <br />
        <hr />
        @if($results->count() > 0)
            @foreach($results as $result)
                {{ $result->title_short }} {{ $result->c }}:{{ $result->v }} Reads > {{ $result->t }}
                <br />
                <hr />
            @endforeach
        @else
            No Texts found
        @endif
    @else
        <form method="post" action="/search">
            @csrf
            <input type="text" name="term" placeholder="Search term">
            <select name="version">
                <option value="kjv">KJV</option>
                <option value="asv">ASV</option>
                <option value="web">WEB</option>
                <option value="ylt">YLT</option>
                <option value="bbe">BBE</option>
            </select>
            <button type="submit">Search</button>
        </form>
    @endif
</x-layout_search>