<div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">

<x-slot name="header">
  <!-- Use Tailwind classes to style the header -->
  <div class="py-0 px-6 bg-white-200">
    <h2 class="text-xl font-semibold text-gray-800 leading-tight">
      {{ ucfirst(strtolower($user->first_name)) }} {{ ucfirst(strtolower($user->last_name)) }}
      <div>
        <img class="py-2 px-2 h-32 rounded-3xl" src="{{ asset('storage/'.$user->profile_picture) }}">
      </div>
    </h2>
  </div>
</x-slot>

<!-- Use Tailwind classes to style the nav links -->
<div class="py-6 px-6 bg-white-200">
  <div class="flex justify-center">
    <x-responsive-nav-link wire:click="setSection('posts')" style="user-select: none;" class="px-2 py-1 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50" :active="$section === 'posts'">
      Posts
    </x-responsive-nav-link>
    <x-responsive-nav-link wire:click="setSection('comments')" style="user-select: none;" class="px-2 py-1 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50" :active="$section === 'comments'">
      Comments
    </x-responsive-nav-link>
    <x-responsive-nav-link wire:click="setSection('liked_posts')" style="user-select: none;" class="px-2 py-1 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50" :active="$section === 'liked_posts'">
      Liked Posts
    </x-responsive-nav-link>
    <x-responsive-nav-link wire:click="setSection('liked_comments')" style="user-select: none;" class="px-2 py-1 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50" :active="$section=== 'liked_comments'">
      Liked Comments
    </x-responsive-nav-link>

  </div>
</div>
<!-- Use Tailwind classes to style the table and center it on the page -->
<div class="container mx-auto max-w-3xl py-2" wire:poll.2s>
  <tbody>
  @if($section === 'posts')
  @foreach ($user->posts()->get()->sortBy('created_at')->reverse() as $post)
  <button class="card-body py-1 w-full rounded-xl text-left" data-post-id="{{ $post->id }}" wire:click.stop="goToPost({{ $post->id }})">
        <!-- Use the flex class to align the elements horizontally -->
        <div class="px-5 pt-5 flex rounded-xl bg-white hover:bg-blue-50 active:bg-blue-50 shadow-xl " >
          <div>
            <div class="flex items-center">
              <img class="w-12 h-12 rounded-full mr-4 max-w-4xl" src="{{ asset('/storage/'.$post->user->profile_picture)}}">
              <a class="text-lg font-bold hover:text-blue-700 active:text-blue-700" href="{{ route('profile', $post->user->user_name) }}">{{ $post->user->first_name }} {{ $post->user->last_name }}</a> ‎ @‎{{$post->user->user_name}}  · @if($post->created_at->diffInDays(now()) < 2) {{ $post->created_at->diffForHumans() }} @else {{$post->created_at->toFormattedDateString()}} @endif
            </div>
            <!-- Use the card-text class to style the post content -->
            <p class="card-text py-2 text-base break-normal">{{ $post->content }}</p>

            @if($post->image != null)
              <img class="flex max-h-96	rounded-xl mb-2 shadow-xl" src="{{asset('storage/'.$post->image->path)}}">
            @endif
            <div class="items-center pb-4">
              <livewire:upvote :likeableType="'App\\Models\\Post'" :likeableId="$post->id" :wire:key="'post-like-' . $post->id" />
            </div> 
          </div>
        </div>
		  </button>
      @endforeach
  @endif
  @if($section === 'comments')
      @foreach ($user->comments()->get()->sortBy('created_at')->reverse() as $comments)
      <button class="card-body py-1 w-full rounded-xl text-left" data-comment-id="{{ $comments->id }}" wire:click.stop="goToPost({{ $comments->post->id }})">
        <!-- Use the flex class to align the elements horizontally -->
        <div class="px-5 pt-5 flex rounded-xl bg-white hover:bg-blue-50 active:bg-blue-50 shadow-xl " >
          <div>
            <div class="flex items-center">
              <img class="w-12 h-12 rounded-full mr-4 max-w-4xl" src="{{ asset('/storage/'.$comments->user->profile_picture)}}">
              <a class="text-lg font-bold hover:text-blue-700 active:text-blue-700" href="{{ route('profile', $comments->user->user_name) }}">{{ $comments->user->first_name }} {{ $comments->user->last_name }}</a> ‎ @‎{{$comments->user->user_name}}  · @if($comments->created_at->diffInDays(now()) < 2) {{ $comments->created_at->diffForHumans() }} @else {{$comments->created_at->toFormattedDateString()}} @endif
            </div>
            <!-- Use the card-text class to style the post content -->
            <p class="card-text py-2 text-base break-normal">{{ $comments->content }}</p>

            <div class="items-center pb-4">
              <livewire:upvote :likeableType="'App\\Models\\Comment'" :likeableId="$comments->id" :wire:key="'comment-like-' . $comments->id" />
            </div> 
          </div>
        </div>
		  </button>
      @endforeach
  @endif
  @if($section === 'liked_posts')
      @foreach ($user->likedPosts()->get()->sortBy('created_at')->reverse() as $likedPosts)

      <button class="card-body py-1 w-full rounded-xl text-left" data-post-id="{{ $likedPosts->id }}" wire:click.stop="goToPost({{ $likedPosts->id }})">
        <!-- Use the flex class to align the elements horizontally -->
        <div class="px-5 pt-5 flex rounded-xl bg-white hover:bg-blue-50 active:bg-blue-50 shadow-xl " >
          <div>
            <div class="flex items-center">
              <img class="w-12 h-12 rounded-full mr-4 max-w-4xl" src="{{ asset('/storage/'.$likedPosts->user->profile_picture)}}">
              <a class="text-lg font-bold hover:text-blue-700 active:text-blue-700" href="{{ route('profile', $likedPosts->user->user_name) }}">{{ $likedPosts->user->first_name }} {{ $likedPosts->user->last_name }}</a> ‎ @‎{{$likedPosts->user->user_name}}  · @if($likedPosts->created_at->diffInDays(now()) < 2) {{ $likedPosts->created_at->diffForHumans() }} @else {{$likedPosts->created_at->toFormattedDateString()}} @endif
            </div>
            <!-- Use the card-text class to style the post content -->
            <p class="card-text py-2 text-base break-normal">{{ $likedPosts->content }}</p>
            
            @if($likedPosts->image != null)
              <img class="flex max-h-96	rounded-xl mb-2 shadow-xl" src="{{asset('storage/'.$likedPosts->image->path)}}">
            @endif

            <div class="items-center pb-4">
              <livewire:upvote :likeableType="'App\\Models\\Post'" :likeableId="$likedPosts->id" :wire:key="'post-like-' . $likedPosts->id" />
            </div> 
          </div>
        </div>
		  </button>
      @endforeach
  @endif
  @if($section === 'liked_comments')
  @foreach ($user->likedComments()->get()->sortBy('created_at')->reverse() as $likedComments)
  <button class="card-body py-1 w-full rounded-xl text-left" data-comment-id="{{ $likedComments->id }}" wire:click.stop="goToPost({{ $likedComments->post->id }})">
        <!-- Use the flex class to align the elements horizontally -->
        <div class="px-5 pt-5 flex rounded-xl bg-white hover:bg-blue-50 active:bg-blue-50 shadow-xl " >
          <div>
            <div class="flex items-center">
              <img class="w-12 h-12 rounded-full mr-4 max-w-4xl" src="{{ asset('/storage/'.$likedComments->user->profile_picture)}}">
              <a class="text-lg font-bold hover:text-blue-700 active:text-blue-700" href="{{ route('profile', $likedComments->user->user_name) }}">{{ $likedComments->user->first_name }} {{ $likedComments->user->last_name }}</a> ‎ @‎{{$likedComments->user->user_name}}  · @if($likedComments->created_at->diffInDays(now()) < 2) {{ $likedComments->created_at->diffForHumans() }} @else {{$likedComments->created_at->toFormattedDateString()}} @endif
            </div>
            <!-- Use the card-text class to style the post content -->
            <p class="card-text py-2 text-base break-normal">{{ $likedComments->content }}</p>
            <div class="items-center pb-4">
              <livewire:upvote :likeableType="'App\\Models\\Comment'" :likeableId="$likedComments->id" :wire:key="'comment-like-' . $likedComments->id" />
            </div> 
          </div>
        </div>
		  </button>
      @endforeach
  @endif
  </tbody>
</table>
@livewireScripts

</div>
