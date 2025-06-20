<div>
    <h1>Bible Chapters</h1>
    @if($results)
        <h1>{{ $firstTitle }} Chapter {{ $chapterByChapter }} ({{ strtoupper($bibleVersionByChapter ?? "kjv") }})</h1>
        <hr />
        @foreach($results as $result)
            {{ $result->v }}. {{ $result->t }}<br />
            <hr />
        @endforeach
    @else
        <p>No Texts found. Try creating some. </p>
    @endif
</div>
