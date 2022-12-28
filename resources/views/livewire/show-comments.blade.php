<div>
<!-- Use the list-group class to style the comments -->
<ul class="list-group list-group-flush">
    @foreach ($post->comments as $comment)
        <!-- Use the list-group-item class to style each comment -->
        <li class="list-group-item" data-comment-id="{{ $comment->id }}">
            <!-- Use the media class to style the comment avatar and content -->
            <div class="media">
                <!-- Use the rounded-circle class to style the comment avatar -->
                <img src="{{ $comment->user->profile_picture }}" class="mr-3 rounded-circle" style="width: 32px; height: 32px;">
                <div class="media-body">
                    <!-- Use the mb-0 class to remove the bottom margin from the comment username -->
                    <h5 class="mt-0 mb-0">
                        <!-- Add an anchor element and set the href attribute to the URL of the user's profile page -->
                        <a href="{{ route('users.show', $comment->user) }}">{{ $comment->user->first_name }} {{ $comment->user->last_name }}</a>
                    </h5>
                    <!-- Use the small class to style the comment timestamp -->
                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                    <!-- Use the card-text class to style the comment content -->
                    <p class="card-text">{{ $comment->content }}</p>

                    <livewire:upvote :likeableType="'App\\Models\\Comment'" :likeableId="$comment->id" :wire:key="'comment-like-' . $comment->id"/>
                    @if(Auth::check() && Auth::user()->id == $comment->user_id)
                        <livewire:comment-delete :commentId="$comment->id" :wire:key="'comment-delete-' . $comment->id"/>
                    @endif

                </div>
            </div>
        </li>
    @endforeach
    </ul>
</div>
