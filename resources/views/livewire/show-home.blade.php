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

<table class="table-auto bg-white shadow-md rounded-md mt-6 mx-auto" wire:poll.2s>
  @foreach (\App\Models\Post::all()->sortBy('created_at')->reverse() as $posts)
  <tr class="odd:bg-white even:bg-slate-50 border-b border-gray-200">
          <td class="px-6 py-4 text-left">
            <a href="{{route('profile', ['user_name' => $posts->user->user_name])}}">
              <!-- Use Tailwind classes to style the profile picture -->
              <img class="w-12 h-12 rounded-full" src="{{ $posts->user->profile_picture}}">
            </a>
          </td>
          <td class="px-6 py-4 text-left max-w-3xl text-base leading-5 font-medium text-gray-900">
            <h4 class="text-left text-xs">{{ $posts->user->first_name }} {{ $posts->user->last_name }} wrote a <a class="text-blue-700" href="{{route('post', ['id' => $posts->id])}}"> post</a> {{ $posts->created_at->diffForHumans() }}.</h4>
            <div class="whitespace-pre-line py-2 text-base text-black-500">{{ $posts->content }}</div>
            <livewire:upvote :likeableType="'App\\Models\\Post'" :likeableId="$posts->id" :wire:key="'post-like-' . $posts->id"/>
          </td>
        </tr>  
  @endforeach
  </table>
</div>
