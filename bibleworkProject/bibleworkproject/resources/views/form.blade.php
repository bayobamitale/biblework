<form method="POST" action="{{ route('search') }}">
    @csrf
    <input type="text" name="term" placeholder="Search term">
    <select name="version">
        <option value="kjv">KJV</option>
        <option value="asv">ASV</option>
        <option value="ylt">YLT</option>
        <option value="web">WEB</option>
        <option value="bbe">BBE</option>
    </select>
    <button type="submit">Search</button>
</form>