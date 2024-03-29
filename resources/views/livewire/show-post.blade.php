<div>
    <!-- Include the link to the stylesheet from the CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
    <!-- Add the Livewire scripts --> @livewireScripts
    <!-- Use the container class to center the content -->
    @if ( $post->flair == "twitch") 
    <div class="container mx-auto max-w-3xl py-2" wire:poll.visible>
        <div class="card-body py-1 w-full rounded-xl text-left">
            <!-- Use the flex class to align the elements horizontally -->
            <div class="px-5 pt-5 flex rounded-t-xl bg-white shadow-xl" data-post-id="{{ $post->id }}">
                <div class="w-full">
                    <div class="flex items-center">
                        <img class="w-12 h-12 rounded-full mr-4 max-w-4xl" src="{{ asset('storage/'. $post->user->profile_picture) }}">
                        <a class="text-lg font-bold hover:text-blue-700 active:text-blue-700" href="{{ route('profile', $post->user->user_name) }}">{{ $post->user->first_name }} {{ $post->user->last_name }}</a> ‎ @‎{{$post->user->user_name}}  · @if($post->created_at->diffInDays(now()) < 2) {{ $post->created_at->diffForHumans() }} @else {{$post->created_at->toFormattedDateString()}} @endif
                    </div>
                    <!-- Use the card-text class to style the post content -->
                    <p class="card-text py-2 text-base break-normal">{{json_decode($post->content, true)['username'] }} is number {{json_decode($post->content, true)['position'] }} in the top 20 streamers for the day!</p>
                    <p class="card-text py-2 text-base break-normal">Check out his stream below!</p>
                    <a href="{{ json_decode($post->content, true)['url'] }}" class="card-text py-2 text-blue-500 hover:underline text-base break-normal" x-data x-on:click.stop="">{{json_decode($post->content, true)['title'] }}</a>
                    <br><br>
                    <img class="flex w-full	rounded-xl mb-2 shadow-xl" src="{{json_decode($post->content, true)['thumbnail_url'] }}">
                    <div class="items-center">
                        <livewire:upvote :likeableType="'App\\Models\\Post'" :likeableId="$post->id" :wire:key="'post-like-' . $post->id" />
                    </div>
                    @if(Auth::check() && (Auth::user()->id == $post->user_id || Auth::user()->priority == 1))
                    <div class="flex">
                        <livewire:post-delete :postId="$post->id" :wire:key="'post-delete-' . $post->id" />
                    </div>
                    @endif
                </div>
            </div>
            <livewire:comment-create :post_id="$post->id" />
        </div>
        <livewire:show-comments :post="$post" />
    </div>
    @else
    <div class="container mx-auto max-w-3xl py-2" wire:poll.visible>
        <div class="card-body py-1 w-full rounded-xl text-left">
            <!-- Use the flex class to align the elements horizontally -->
            <div class="px-5 pt-5 flex w-full rounded-t-xl bg-white shadow-xl" data-post-id="{{ $post->id }}">
                <div class="w-full">
                    <div class="flex items-center">
                        <img class="w-12 h-12 rounded-full mr-4 max-w-4xl" src="{{ asset('/storage/'.$post->user->profile_picture)}}">
                        <a class="text-lg font-bold hover:text-blue-700 active:text-blue-700" href="{{ route('profile', $post->user->user_name) }}">{{ $post->user->first_name }} {{ $post->user->last_name }}</a> ‎ @‎{{$post->user->user_name}}  · @if($post->created_at->diffInDays(now()) < 2) {{ $post->created_at->diffForHumans() }} @else {{$post->created_at->toFormattedDateString()}} @endif
                    </div>
                    @if(Auth::check() && (Auth::user()->id == $post->user_id || Auth::user()->priority == 1))
                    <div class="items-center">
                        @livewire('post-edit', compact('post'), key($post->id))
                    </div>
                    @endif
                    @if(Auth::check() && (Auth::user()->id != $post->user_id && Auth::user()->priority != 1))
                    <p class="card-text py-2 text-base break-normal" data-post-edit-id="{{'post-edit-' . $post->id }}">{{ $post->content }}</p>
                    @endif
                    @if($post->image != null)
                    <img class="flex mx-auto rounded-xl mb-2 shadow-xl" src="{{asset('storage/'.$post->image->path)}}">
                    @endif
                    <div class="flex items-center">
                        <livewire:upvote :likeableType="'App\\Models\\Post'" :likeableId="$post->id" :wire:key="'post-like-' . $post->id" />
                    </div>
                    @if(Auth::check() && (Auth::user()->id == $post->user_id || Auth::user()->priority == 1))
                    <div class="flex">
                        <livewire:post-delete :postId="$post->id" :wire:key="'post-delete-' . $post->id" />
                    </div>
                    @endif
                </div>
            </div>
            <livewire:comment-create :post_id="$post->id" />
        </div>
        <livewire:show-comments :post="$post" />
    </div>
    @endif
</div>