<style>
    textarea,
    textarea:hover,
    textarea:focus {
    width: 100%;
    background-color: #F3F4F6FF !important;
    }
    button:hover {
    color: purple;
    }
    table.table1 {
    margin: auto;
    width: 45%;
    }
    td.light {
    box-shadow: 0 4px 6px -1px rgba(0, 255, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.25);
    padding: 5px;
    }
    td.dark {
    box-shadow: 0 4px 6px -1px rgba(255, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.50);
    padding: 5px;
    }
    .space {
    border-collapse: separate;
    border-spacing: 0 10px;
    }
    .post-info {
    font-size: 12px;
    color: gray;
    }
    .username {
    font-weight: bold;
    color: blue;
    }
    .username:hover {
    color: purple;
    }
    .upvoted {
    font-weight: bold;
    color: green;  
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php
    $post = \App\Models\Post::findOrFail($posts->id);
    $likePost = \App\Models\Likeable::where([
        ['likeable_id', $post->id],
        ['likeable_type', 'App\Models\Post'],
        ['user_id', auth()->user()->id],
    ])->first();
    ?>
<x-app-layout>
    <table class="table1 space">
        <tr>
            <td>
                <table class="table1 space">
                    <tr>
                        <td style="vertical-align: center; text-align:center;">
                            @php
                            $user = auth()->user();
                            $upvote = \App\Models\Likeable::where([
                            ['likeable_id', $post->id],
                            ['likeable_type', 'App\Models\Post'],
                            ['user_id', $user->id],
                            ])->first();
                            @endphp
                            @if($upvote)
                            <button id="upvote-post-button" class="upvoted" data-post-id="{{ $post->id }}">{{count($posts->likeables)}}</button>
                            @else
                            <button id="upvote-post-button" data-post-id="{{ $post->id }}">{{count($posts->likeables)}}</button>
                            @endif
                            <script>
                                $('#upvote-post-button').click(function() {
                                    // Send a POST request to the server using AJAX
                                    $.ajax({
                                    url: "/upvote",
                                    type: 'GET', // the type of request
                                    data: { // the data to send to the server
                                        _token: '@csrf', // CSRF token
                                        likeable_id: $(this).data('post-id'),
                                        likeable_type: 'App\\Models\\Post',
                                        user_id: '{{auth()->user()->id}}'
                                    },
                                    success: function(response) { // function to be called if the request is successful
                                        $('#upvote-post-button').text(response.likes);
                                        if (response.upvoted) {
                                            $('#upvote-post-button').addClass('upvoted');
                                        } else {
                                            $('#upvote-post-button').removeClass('upvoted');
                                        }
                                    },
                                    error: function(xhr, status, error) { // function to be called if the request fails
                                        alert('An error occurred: ' + error);
                                    }
                                    });
                                });
                            </script>
                        </td>
                    </tr>
                </table>
            </td>
            <td class="dark" style="text-align: center;">
                <div class="post-info">
                    Posted by <a class="username" href="{{ route('users.show', $posts->user) }}">{{ $posts->user->first_name }}</a>
                    @if ($posts->created_at->diffInMinutes(now()) < 60)
                    {{ $posts->created_at->diffInMinutes(now()) }} minutes ago.
                    @elseif ($posts->created_at->diffInHours(now()) < 24)
                    {{ $posts->created_at->diffInHours(now()) }} hours ago.
                    @elseif ($posts->created_at->diffInDays(now()) < 365)
                    {{ $posts->created_at->diffInDays(now()) }} days ago.
                    @else
                    {{ $posts->created_at->diffInYears(now()) }} years ago.
                    @endif
                    @if ($posts->updated_at)
                    (Edited)
                    @endif
                </div>
                {{ $posts->content }}
            </td>
        </tr>
        @foreach ($posts->comments as $comment)
        <?php
            $comments = \App\Models\Comment::findOrFail($comment->id);
            $likeComment = \App\Models\Likeable::where([
                ['likeable_id', $comments->id],
                ['likeable_type', 'App\Models\Comment'],
                ['user_id', auth()->user()->id],
            ])->first();
            ?>
        <tr>
            <td><a href="{{route('users.show', ['id' =>$comment->user->id])}}"><img style="border-radius: 50%;" src="{{ $comment->user->profile_picture}}"></a></td>
            <td class="light" style="text-align: center;" >
                <div class="post-info">
                    <a class="username" href="{{ route('users.show', $comment->user) }}">{{ $comment->user->first_name }}</a> commented
                    @if ($comment->created_at->diffInMinutes(now()) < 60)
                    {{ $comment->created_at->diffInMinutes(now()) }} minutes ago.
                    @elseif ($comment->created_at->diffInHours(now()) < 24)
                    {{ $comment->created_at->diffInHours(now()) }} hours ago.
                    @elseif ($comment->created_at->diffInDays(now()) < 365)
                    {{ $comment->created_at->diffInDays(now()) }} days ago.
                    @else
                    {{ $comment->created_at->diffInYears(now()) }} years ago.
                    @endif
                    @if ($comment->updated_at != $comment->created_at)
                    (Edited)
                    @endif
                </div>
                {{ $comment->content }}
                <br> 
                <table style="width:100%; font-size:12px;">
                    <td>
                        @if ($comment->user_id != auth()->user()->id) 
                        @php
                        $user = auth()->user();
                        $upvoteComment = \App\Models\Likeable::where([
                        ['likeable_id', $comment->id],
                        ['likeable_type', 'App\Models\Comment'],
                        ['user_id', $user->id],
                        ])->first();
                        @endphp
                        @if($upvoteComment)
                        <button id="upvote-comment-button" class="upvoted" data-comment-id="{{ $comment->id }}">{{count($comments->likeables)}}</button>
                        @else
                        <button id="upvote-comment-button" data-comment-id="{{ $comment->id }}">{{count($comments->likeables)}}</button>
                        @endif
                        @endif
                    </td>
                    <td>
                        @if ($comment->user_id == auth()->user()->id)
                        <form style="text-align:right"  action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="comment_id" value="{{$comments->id}}">
                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        @endif
                    </td>
                </table>
            </td>
        </tr>
        @endforeach
        <script>
            $('button[data-comment-id]').click(function() {
                var button = $(this); // store a reference to the clicked button
            
                // Send a POST request to the server using AJAX
                $.ajax({
                url: "/upvote",
                type: 'GET', // the type of request
                data: { // the data to send to the server
                    _token: '@csrf', // CSRF token
                    likeable_id: $(this).data('comment-id'),
                    likeable_type: 'App\\Models\\Comment',
                    user_id: '{{auth()->user()->id}}'
                },
                success: function(response) { // function to be called if the request is successful
                    // update the text of the clicked button
                    button.text(response.likes);
                    if (response.upvoted) {
                    button.addClass('upvoted');
                    } else {
                    button.removeClass('upvoted');
                    }
                },
                error: function(xhr, status, error) { // function to be called if the request fails
                    alert('An error occurred: ' + error);
                }
                });
            });
        </script> 
        <td></td>
        <td>
            <form action="{{ route('comments.store', auth()->user()->id) }}" method="POST">
                @csrf
                <input type="hidden" name="post_id" value="{{ $posts->id }}">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <textarea style="textarea" name="content" rows="3" placeholder="Add a comment..." required></textarea>
        <td>
        <button type="submit" class="btn btn-primary">Comment</button></td>
        </form>
        </td>
    </table>
</x-app-layout>