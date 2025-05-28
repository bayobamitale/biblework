<div>
    <h1>Compare Versions</h1>
    @if($results1)
        <h1>{{ $firstTitle }} Chapter {{ $chapterByCompare }} Verse {{ $verseByCompare }} ({{ strtoupper($bibleVersion1 ?? "kjv") }})</h1>
        <hr />
        @foreach($results1 as $result)
            {{ $result->v }}. {{ $result->t }}<br />
            <hr />
        @endforeach
    @else
        <p>No Texts found</p>
    @endif

    @if($results2)
        <h1>{{ $firstTitle }} Chapter {{ $chapterByCompare }} Verse {{ $verseByCompare }} ({{ strtoupper($bibleVersion2 ?? "kjv") }})</h1>
        <hr />
        @foreach($results2 as $result)
            {{ $result->v }}. {{ $result->t }}<br />
            <hr />
        @endforeach
    @else
        <p>No Texts found</p>
    @endif
</div>
