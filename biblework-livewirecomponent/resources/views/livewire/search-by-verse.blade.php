<div>
    <h1>Bible Verse</h1>
    @if($results)
        <h1>{{ $firstTitle }} Chapter {{ $chapterByVerse }} Verse {{ $verseByVerse }} ({{ strtoupper($bibleVersionByVerse ?? "kjv") }})</h1>
        <hr />
        @foreach($results as $result)
            {{ $result->v }}. {{ $result->t }}<br />
            <hr />
        @endforeach
    @else
        <p>No Texts found</p>
    @endif
</div>
