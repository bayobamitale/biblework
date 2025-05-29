<x-layout_search>
    <h1>Bible Verse</h1>
    <h1>{{ $bookTitle }} Chapter {{ $chapter }} Verse {{ $verse }} ({{ $bibleVersion }})</h1>
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