<x-layout_search>
    <h1>Compare Versions</h1>
    <h1>{{ $bookTitle }} Chapter {{ $chapter }} Verse {{ $verse }} ({{ $bibleVersion1 }})</h1>
    <br />
    <hr />
    @if($verses1->count() > 0)
        @foreach($verses1 as $verse1)
            {{ $verse1->v }}. {{ $verse1->t }}
            <br />
            <hr />
        @endforeach
    @else
        No Texts found
    @endif

    <h1>{{ $bookTitle }} Chapter {{ $chapter }} Verse {{ $verse }} ({{ $bibleVersion2 }})</h1>
    <br />
    <hr />
    @if($verses2->count() > 0)
        @foreach($verses2 as $verse2)
            {{ $verse2->v }}. {{ $verse2->t }}
            <br />
            <hr />
        @endforeach
    @else
        No Texts found
    @endif
</x-layout_search>