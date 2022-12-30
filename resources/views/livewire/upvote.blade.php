<div class="flex items-center">
    <a wire:click="{{ $upvoted ? 'unupvote' : 'upvote' }}" x-data x-on:click.stop="" class="mr-2">
        <!-- Use the $upvoted variable to determine which image to display -->
        <img src="{{ $upvoted ? asset('/images/canvas-heart-upvoted.png') : asset('/images/canvas-heart.png') }}" width="15" height="15">
    </a>
    {{ $likes }}
</div>
