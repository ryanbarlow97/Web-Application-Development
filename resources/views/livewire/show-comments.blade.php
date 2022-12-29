<div>
	<!-- Use the list-group class to style the comments -->
	<ul class="card mb-3">
		@foreach ($post->comments()->orderBy('created_at', 'asc')->get() as $comment)
		<!-- Use the list-group-item class to style each comment -->
		<li class="card-body p-6">
			<!-- Use the media class to style the comment avatar and content -->
			<div class="px-5 flex items-center mb-4 rounded-xl shadow-lg" data-post-id="{{ $post->id }}">
				<div>
					<!-- Use the mb-0 class to remove the bottom margin from the comment username -->
					<h5 class="text-lg mb-0">
						<div class="font-bold flex items-center">
						<img class="w-12 h-12 rounded-full mr-4 max-w-4xl" src="{{ $comment->user->profile_picture}}">
						<a href="{{ route('profile', $comment->user->user_name) }}">{{ $comment->user->first_name }} {{ $comment->user->last_name }}</a>
						</div>
						<!-- Use the small class to style the comment timestamp -->
						<small class="text-gray-700">{{ $comment->created_at->diffForHumans() }}</small>
					</h5>
					<!-- Use the card-text class to style the comment content -->
					<p class="card-text text-base py-4 break-words">{{ $comment->content }}</p>
					<div>
						<div class="flex items-center py-2 mb-4">
							<livewire:upvote :likeableType="'App\\Models\\Comment'" :likeableId="$comment->id" :wire:key="'comment-like-' . $comment->id"/>
						</div>
						@if(Auth::check() && Auth::user()->id == $comment->user_id)
						<div class="flex items-center mb-4">
							<livewire:comment-delete :commentId="$comment->id" :wire:key="'comment-delete-' . $comment->id"/>
						</div>
						@endif
					</div>
				</div>

			</div>
		</li>
		@endforeach
	</ul>
</div>