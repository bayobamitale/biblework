<h1>Bible Search</h1>

<h2>Keyword: {{ $searchText }}</h2>

<hr />

@if ($results->count() > 0)
    @foreach ($results as $result)
        {{ $result->title_short }} {{ $result->c }}:{{ $result->v }} Reads > {{ $result->t }}<br><hr>
    @endforeach
@else
    No Texts found
@endif
