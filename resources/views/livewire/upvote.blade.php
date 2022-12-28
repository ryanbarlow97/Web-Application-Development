<div style="display: flex; flex-wrap: nowrap; align-items: center;">
    <a wire:click="{{ $upvoted ? 'unupvote' : 'upvote' }}" class="{{ $upvoted ? 'upvoted' : '' }}" style="display: inline-block; margin-right: 5px;">
        <!-- Use the $upvoted variable to determine which image to display -->
        <img src="{{ $upvoted ? asset('/images/canvas-heart-upvoted.png') : asset('/images/canvas-heart.png') }}" width="15" height="15">
    </a>
    {{ $likes }}
</div>
