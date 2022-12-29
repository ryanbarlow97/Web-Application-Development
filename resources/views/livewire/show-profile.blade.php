<div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">

<x-slot name="header">
  <!-- Use Tailwind classes to style the header -->
  <div class="py-0 px-6 bg-white-200">
    <h2 class="text-xl font-semibold text-gray-800 leading-tight">
      {{ ucfirst(strtolower($user->first_name)) }} {{ ucfirst(strtolower($user->last_name)) }}
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
<table class="table-auto bg-white shadow-md rounded-md mt-6 mx-auto" wire:poll.2s>
  <tbody>
  @if($section === 'posts')
  @foreach ($user->posts()->get()->sortBy('created_at')->reverse() as $posts)
        <tr class="border-b border-gray-200">
          <td class="px-6 py-4 text-left">
            <a href="{{route('profile', ['user_name' => $posts->user->user_name])}}">
              <!-- Use Tailwind classes to style the profile picture -->
              <img class="w-12 h-12 rounded-full" src="{{ $posts->user->profile_picture}}">
            </a>
          </td>
          <td class="px-6 py-4 text-left max-w-3xl text-base leading-5 font-medium text-gray-900">
            <!-- Wrap the content in a div and use the whitespace-pre-line utility class to force text to go into separate lines -->
            <h4 class="text-left text-xs">{{ $user->first_name }} {{ $user->last_name }} wrote a <a class="text-blue-700" href="{{route('post', ['id' => $posts->id])}}"> post</a> {{ $posts->created_at->diffForHumans() }}.</h4>
            <div class="whitespace-pre-line py-2 text-base text-black-500">{{ $posts->content }}</div>
            <livewire:upvote :likeableType="'App\\Models\\Post'" :likeableId="$posts->id" :wire:key="'post-like-' . $posts->id"/>
          </td>
        </tr>
      @endforeach
  @endif
  @if($section === 'comments')
      @foreach ($user->comments()->get()->sortBy('created_at')->reverse() as $comments)
      
        <tr class="border-b border-gray-200">
          <td class="px-6 py-4 text-left">
            <a href="{{route('profile', ['user_name' => $comments->user->user_name])}}">
              <!-- Use Tailwind classes to style the profile picture -->
              <img class="w-12 h-12 rounded-full" src="{{ $comments->user->profile_picture}}">
            </a>
          </td>
          <td class="px-6 py-4 text-left max-w-3xl text-base leading-5 font-medium text-gray-900">
            <!-- Wrap the content in a div and use the whitespace-pre-line utility class to force text to go into separate lines -->
            <h4 class="text-left text-xs">{{ $user->first_name }} {{ $user->last_name }} wrote a comment on <a class="text-blue-700" href="{{route('profile', ['user_name' => $comments->post->user->user_name])}}">{{ $comments->post->user->first_name }} {{ $comments->post->user->last_name }}'s</a> <a class="text-blue-700" href="{{route('post', ['id' => $comments->post->id])}}">post</a> {{ $comments->created_at->diffForHumans() }}.</h4>
            <div class="whitespace-pre-line py-2 text-base text-black-500">{{ $comments->content }}</div>
            <livewire:upvote :likeableType="'App\\Models\\Comment'" :likeableId="$comments->id" :wire:key="'comments-like-' . $comments->id"/>
          </td>
        </tr>
      @endforeach
  @endif
  @if($section === 'liked_posts')
      @foreach ($user->likedPosts()->get()->sortBy('created_at')->reverse() as $likedPosts)
        <tr class="border-b border-gray-200">
          <td class="px-6 py-4 text-left">
            <a href="{{route('profile', ['user_name' => $likedPosts->user->user_name])}}">
              <!-- Use Tailwind classes to style the profile picture -->
              <img class="w-12 h-12 rounded-full" src="{{ $likedPosts->user->profile_picture}}">
            </a>
          </td>
          <td class="px-6 py-4 text-left max-w-3xl text-base leading-5 font-medium text-gray-900">
            <!-- Wrap the content in a div and use the whitespace-pre-line utility class to force text to go into separate lines -->
            <h4 class="text-left text-xs">{{ $user->first_name }} {{ $user->last_name }} liked a <a class="text-blue-700" href="{{route('post', ['id' => $likedPosts->id])}}">post</a> by <a class="text-blue-700" href="{{route('profile', ['user_name' => $likedPosts->user->user_name])}}">{{ $likedPosts->user->first_name }} {{ $likedPosts->user->last_name }}</a> made {{ $likedPosts->created_at->diffForHumans() }}.</h4>
            <div class="whitespace-pre-line py-2 text-base text-black-500">{{ $likedPosts->content }}</div>
            <livewire:upvote :likeableType="'App\\Models\\Post'" :likeableId="$likedPosts->id" :wire:key="'post-like-' . $likedPosts->id"/>

          </td>
        </tr>
      @endforeach
  @endif
  @if($section === 'liked_comments')
  @foreach ($user->likedComments()->get()->sortBy('created_at')->reverse() as $likedComments)
        <tr class="border-b border-gray-200">
          <td class="px-6 py-4 text-left">
            <a href="{{route('profile', ['user_name' => $likedComments->post->user->user_name])}}">
              <!-- Use Tailwind classes to style the profile picture -->
              <img class="w-12 h-12 rounded-full" src="{{ $likedComments->user->profile_picture}}">
            </a>
          </td>
          <td class="px-6 py-4 text-left max-w-3xl text-base leading-5 font-medium text-gray-900">
            <!-- Wrap the content in a div and use the whitespace-pre-line utility class to force text to go into separate lines -->
            <h4 class="text-left text-xs">{{ $user->first_name }} {{ $user->last_name }} liked a comment by <a class="text-blue-700" href="{{route('profile', ['user_name' => $likedComments->post->user->user_name])}}">{{ $likedComments->user->first_name }} {{ $likedComments->user->last_name }}</a> on <a class="text-blue-700" href="{{route('profile', ['user_name' => $likedComments->post->user->user_name])}}">{{ $likedComments->post->user->first_name }} {{ $likedComments->post->user->last_name }}'s</a> <a class="text-blue-700" href="{{route('post', ['id' => $likedComments->post->id])}}">post</a> made {{ $likedComments->created_at->diffForHumans() }}.</h4>
            <div class="whitespace-pre-line py-2 text-base text-black-500">{{ $likedComments->content }}</div>
            <livewire:upvote :likeableType="'App\\Models\\Comment'" :likeableId="$likedComments->id" :wire:key="'comment-like-' . $likedComments->id"/>

          </td>
        </tr>
      @endforeach
  @endif
  </tbody>
</table>
@livewireScripts

</div>
