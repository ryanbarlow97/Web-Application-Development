<div>
	<ul class="card" wire:poll.visible>
		@foreach ($post->comments()->orderBy('created_at', 'asc')->get() as $comment)
		<li class="card-body pt-2">
			<div class="px-5 py-5 flex items-center rounded-xl shadow-xl bg-white" data-comment-id="{{ $comment->id }}">
				<div>
					<h5>
						<div class="flex items-center">
						<img class="w-12 h-12 rounded-full mr-4 max-w-4xl" src="{{ asset('/storage/'.$comment->user->profile_picture)}}">
						<a class="font-bold text-lg hover:text-blue-700 active:text-blue-700" href="{{ route('profile', $comment->user->user_name) }}">{{ $comment->user->first_name }} {{ $comment->user->last_name }}</a>  ‎ @‎{{$comment->user->user_name}} · @if($comment->created_at->diffInDays(now()) < 2) {{ $comment->created_at->diffForHumans() }} @else {{$comment->created_at->toFormattedDateString()}} @endif
						</div>
					</h5>
					@if(Auth::check() && (Auth::user()->id == $comment->user_id || Auth::user()->priority == 1))
						<div class="items-center">
							@livewire('comment-edit', compact('comment'), key($comment->id))
						</div>
					@endif
					@if(Auth::check() && (Auth::user()->id != $comment->user_id && Auth::user()->priority != 1))
						<div class="items-center">
							<p class="card-text py-2 text-base break-words" data-comment-edit-id="{{$comment->id }}">{{ $comment->content }}</p>
						</div>
					@endif
					
					<div class="items-center">
						<livewire:upvote :likeableType="'App\\Models\\Comment'" :likeableId="$comment->id" :wire:key="'comment-like-' . $comment->id" />
					</div>

					@if(Auth::check() && (Auth::user()->id == $comment->user_id || Auth::user()->priority == 1))
						<div class="items-center">
							<livewire:comment-delete :commentId="$comment->id" :wire:key="'comment-delete-' . $comment->id" />
						</div>
					@endif
				</div>
			</div>
		</li>
		@endforeach
	</ul>
</div>