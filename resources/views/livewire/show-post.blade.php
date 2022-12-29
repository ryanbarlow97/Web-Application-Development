<div>
<!-- Include the link to the stylesheet from the CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
<!-- Add the Livewire scripts --> 
@livewireScripts
<!-- Use the container class to center the content -->
<div class="container mx-auto max-w-3xl">
	<!-- Use the card class to style the post -->
	<div class="card mb-3">
		<div class="card-body p-6">
			<!-- Use the flex class to align the elements horizontally -->
			<div class="px-5 flex items-center mb-4 rounded-xl shadow-xl" data-post-id="{{ $post->id }}">
                <div>
                <h5 class="text-lg mb-0">
						<div class="font-bold flex items-center">
						<img class="w-12 h-12 rounded-full mr-4 max-w-4xl" src="{{ $post->user->profile_picture}}">
						<a href="{{ route('profile', $post->user->user_name) }}">{{ $post->user->first_name }} {{ $post->user->last_name }}</a>
						</div>
						<!-- Use the small class to style the comment timestamp -->
						<small class="text-gray-700">{{ $post->created_at->diffForHumans() }}</small>
					</h5>

					<!-- Use the card-text class to style the post content -->
					<p class="card-text text-base py-4 break-normal">{{ $post->content }}</p>
					<div class="flex items-center mb-4">
						<livewire:upvote :likeableType="'App\\Models\\Post'" :likeableId="$post->id" />
					</div>
                    <livewire:comment-create :post_id="$post->id" />
					@if(Auth::check() && Auth::user()->id == Auth::user()->id)
						<div class="flex items-center mb-4">
							<livewire:post-delete :postId="$post->id" :wire:key="'post-delete-' . $post->id"/>
						</div>
						@endif
				</div>  
			</div>     
		</div>
        <livewire:show-comments :post="$post" />
	</div>
</div>
