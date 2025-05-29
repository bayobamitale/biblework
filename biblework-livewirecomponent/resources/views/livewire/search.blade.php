<div>
    <h2>By Keyword</h2>
    <form wire:submit.prevent="search">
        Text:<input type="text" wire:model="searchTextByKeyword" placeholder="Search keyword" />
        Version:<select wire:model="bibleVersionByKeyword">
            <option value="kjv">King James (KJV)</option>
            <option value="asv">American Standard Version (ASV)</option>
            <option value="web">World English Bible (WEB)</option>
            <option value="ylt">Young's Literal Translation (YLT)</option>
            <option value="bbe">Bible in Basic English(BBE)</option>
        </select>
        <button type="submit">Search</button>
    </form>

    <h2>By Chapter</h2>
    <form wire:submit.prevent="chapter">
        Text:<input type="text" wire:model="bookByChapter" />
        Chapter:<input type="text" wire:model="chapterByChapter" />
        Version:<select wire:model="bibleVersionByChapter">
            <option value="kjv">King James (KJV)</option>
            <option value="web">World English Bible (WEB)</option>
            <option value="ylt">Young's Literal Translation (YLT)</option>
            <option value="asv">American Standard Version (ASV)</option>
            <option value="bbe">Bible in Basic English(BBE)</option>
        </select>
        <button type="submit">Open Chapter</button>
    </form>

    <h2>By Verse</h2>
    <form wire:submit.prevent="verse">
        Text: <input type="text" wire:model="bookByVerse" />  
        Chapter: <input type="text" wire:model="chapterByVerse" />  
        Verse: <input type="text" wire:model="verseByVerse" />        
        Version:
        <select wire:model="bibleVersionByVerse">
            <option value="kjv">King James (KJV)</option>
            <option value="web">World English Bible (WEB)</option>
            <option value="ylt">Young's Literal Translation (YLT)</option>
            <option value="asv">American Standard Version (ASV)</option>
            <option value="bbe">Bible in Basic English(BBE)</option>
        </select>
        <input type="submit" value="Open Verse">
    </form> 

    <h2>Compare Versions Verse</h2>
    <form wire:submit.prevent="compare">
        Text: <input type="text" wire:model="bookByCompare" />  
        Chapter: <input type="text" wire:model="chapterByCompare" />  
        Verse: <input type="text" wire:model="verseByCompare" />        
        Version1:
        <select wire:model="bibleVersion1">
            <option value="kjv">King James (KJV)</option>
            <option value="web">World English Bible (WEB)</option>
            <option value="ylt">Young's Literal Translation (YLT)</option>
            <option value="asv">American Standard Version (ASV)</option>
            <option value="bbe">Bible in Basic English(BBE)</option>
        </select>
        Version2: 
        <select wire:model="bibleVersion2">
            <option value="kjv">King James (KJV)</option>
            <option value="web">World English Bible (WEB)</option>
            <option value="ylt">Young's Literal Translation (YLT)</option>
            <option value="asv">American Standard Version (ASV)</option>
            <option value="bbe">Bible in Basic English(BBE)</option>
        </select>

        <input type="submit" value="Open Verse">
    </form> 

    <h2>By Voice Control</h2>
    <form wire:submit.prevent="voice">
        Word heard: <input type="text" wire:model="searchTextByVoice" id="searchTextByVoice" name="searchTextByVoice" />
        Version: <select wire:model="bibleVersionByVoice" name="bibleVersionByVoice" id="bibleVersionByVoice">
            <option value="kjv">King James (KJV)</option>
            <option value="web">World English Bible (WEB)</option>
            <option value="ylt">Young's Literal Translation (YLT)</option>
            <option value="asv">American Standard Version (ASV)</option>
            <option value="bbe">Bible in Basic English(BBE)</option>
        </select>
        <input type="submit" value="Search" />
    </form>

</div>
