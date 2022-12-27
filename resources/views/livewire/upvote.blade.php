<div>
    <button wire:click="{{ $upvoted ? 'unupvote' : 'upvote' }}" class="{{ $upvoted ? 'upvoted' : '' }}">{{ $likes }}</button>
</div>
