<x-layout_search>
    <h1>Bible Search</h1>
    <h1>Keyword: {{ $searchText }} ({{ $bibleVersion }})</h1>
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
</x-layout_search>