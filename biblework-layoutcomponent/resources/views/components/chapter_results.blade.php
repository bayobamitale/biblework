<x-layout_search>
    <h1>Bible Chapters</h1>
    <br />
    <hr />
    <h1>{{ $title }} Chapter {{ $chapter }} ({{ $bibleVersion }})</h1>
    <br />
    <hr />
    @if($verses->count() > 0)
        @foreach($verses as $verse)
            {{ $verse->v }}. {{ $verse->t }}
            <br />
            <hr />
        @endforeach
    @else
        No Texts found
    @endif
</x-layout_search>