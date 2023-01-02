<div>
	<!-- Use the list-group class to style the comments -->
	<ul class="card" wire:poll.1s>
		@foreach ($post->comments()->orderBy('created_at', 'asc')->get() as $comment)
		<!-- Use the list-group-item class to style each comment -->
		<li class="card-body pt-2">
			<!-- Use the media class to style the comment avatar and content -->
			<div class="px-5 py-5 flex items-center rounded-xl shadow-xl bg-white" data-comment-id="{{ $comment->id }}">
				<div>
					<!-- Use the mb-0 class to remove the bottom margin from the comment username -->
					<h5>
						<div class="flex items-center">
						<img class="w-12 h-12 rounded-full mr-4 max-w-4xl" src="{{ $comment->user->profile_picture}}">
						<a class="font-bold text-lg hover:text-blue-700 active:text-blue-700" href="{{ route('profile', $comment->user->user_name) }}">{{ $comment->user->first_name }} {{ $comment->user->last_name }}</a>  ‎ @‎{{$comment->user->user_name}} · @if($comment->created_at->diffInDays(now()) < 2) {{ $comment->created_at->diffForHumans() }} @else {{$comment->created_at->toFormattedDateString()}} @endif
						</div>
						<!-- Use the small class to style the comment timestamp -->
					</h5>
					<!-- Use the card-text class to style the comment content -->
					@if(Auth::check() && Auth::user()->id == $comment->user_id)
						<div class="items-center">
							@livewire('comment-edit', compact('comment'), key($comment->id))
						</div>
					@endif

					@if(Auth::check() && Auth::user()->id != $comment->user_id)
						<div class="items-center">
							<p class="card-text py-2 text-base break-words" data-comment-edit-id="{{$comment->id }}">{{ $comment->content }}</p>
						</div>
					@endif
					
					<div class="items-center">
						<livewire:upvote :likeableType="'App\\Models\\Comment'" :likeableId="$comment->id" :wire:key="'comment-like-' . $comment->id" />
					</div>

					@if(Auth::check() && Auth::user()->id == $comment->user_id)
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