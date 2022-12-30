<div>
  <!-- Include the link to the stylesheet from the CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
  <!-- Add the Livewire scripts --> 
  @livewireScripts
  <!-- Use the container class to center the content -->
  <div class="container mx-auto max-w-3xl py-2">
    <div data-submit-id="submit-post" class="pb-1">
      <livewire:post-create />
    </div>
    @foreach (\App\Models\Post::all()->sortBy('created_at')->reverse() as $post)
      <button class="card-body py-1 w-full rounded-xl text-left" data-post-id="{{ $post->id }}" wire:click.stop="goToPost({{ $post->id }})">
        <!-- Use the flex class to align the elements horizontally -->
        <div class="px-5 pt-5 flex rounded-xl bg-white hover:bg-blue-50 active:bg-blue-50 shadow-xl " >
          <div>
            <div class="flex items-center">
              <img class="w-12 h-12 rounded-full mr-4 max-w-4xl" src="{{ $post->user->profile_picture}}">
              <a class="text-lg font-bold hover:text-blue-700 active:text-blue-700" href="{{ route('profile', $post->user->user_name) }}">{{ $post->user->first_name }} {{ $post->user->last_name }}</a> ‎ @‎{{$post->user->user_name}}  · @if($post->created_at->diffInDays(now()) < 2) {{ $post->created_at->diffForHumans() }} @else {{$post->created_at->toFormattedDateString()}} @endif
            </div>
            <!-- Use the card-text class to style the post content -->
            <p class="card-text ml-16 py-2 text-base break-normal">{{ $post->content }}</p>
            <div class="items-center pb-4">
              <livewire:upvote :likeableType="'App\\Models\\Post'" :likeableId="$post->id" :wire:key="'post-like-' . $post->id" />
              @if(Auth::check() && Auth::user()->id == $post->user->id) 
                <livewire:home-post-delete :postId="$post->id" :wire:key="'post-delete-' . $post->id" />
              @endif
            </div> 
          </div>
        </div>
		  </button >
    @endforeach
	</div>
</div>