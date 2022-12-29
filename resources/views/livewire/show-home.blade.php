<div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">

<x-slot name="header">
  <!-- Use Tailwind classes to style the header -->
  <div class="py-0 px-6 bg-white-200">
    <h2 class="text-xl font-semibold text-gray-800 leading-tight">
        {{ __('Live Feed') }}
    </h2>
  </div>
</x-slot>

<div class="container mx-auto max-w-3xl py-2">
  @foreach (\App\Models\Post::all()->sortBy('created_at')->reverse() as $post)
  <div class="card-body flex-auto py-2">
		<div class="px-5 py-5 rounded-xl shadow-xl bg-white" data-post-id="{{ $post->id }}">
    <div>
      <div class="flex items-center">
        <img class="w-12 h-12 rounded-full mr-4 max-w-4xl" src="{{ $post->user->profile_picture}}">
        <a class="font-bold text-lg hover:text-blue-700 active:text-blue-700" href="{{ route('profile', $post->user->user_name) }}">{{ $post->user->first_name }} {{ $post->user->last_name }}</a> ‎ @‎{{$post->user->user_name}} · @if($post->created_at->diffInDays(now()) < 2) {{ $post->created_at->diffForHumans() }} @else {{$post->created_at->toFormattedDateString()}} @endif
      </div>
      <p class="card-text text-base py-4 break-normal">{{ $post->content }}</p>
      <div>
				<div class="items-center">
					<livewire:upvote :likeableType="'App\\Models\\Post'" :likeableId="$post->id" :wire:key="'post-like-' . $post->id" />
				</div>
				@if(Auth::check() && Auth::user()->id == Auth::user()->id)
				<div class="items-center">
					<livewire:post-delete :postId="$post->id" :wire:key="'post-delete-' . $post->id"/>
				</div>
				@endif
			</div>
    </div>
  </div>  
  @endforeach
  </div>
</div>
