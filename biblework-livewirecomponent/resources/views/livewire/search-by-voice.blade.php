<div>
    <h1>Bible Search</h1>
    <h1>Keyword: {{ $searchTextByVoice }} ({{ strtoupper($bibleVersionByVoice ?? "kjv") }})</h1>
    <hr />
    @if($results)
        @foreach($results as $result)
            {{ $result->title_short }} {{ $result->c }}:{{ $result->v }} Reads > {{ $result->t }}<br />
            <hr />
        @endforeach
    @else
        <p>No Texts found</p>
    @endif
</div>
