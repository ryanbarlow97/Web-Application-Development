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
    .green {
    font-weight: bold;
    color: green;  
    }
</style>
<?php
    // Define $upvoted as a boolean value indicating whether the current user has upvoted the post
    $upvoted = false;
    
    // Check if the user has upvoted the post
    $post = \App\Models\Post::findOrFail($posts->id);
    $like = \App\Models\Likeable::where([
        ['likeable_id', $post->id],
        ['likeable_type', 'App\Models\Post'],
        ['user_id', auth()->user()->id],
    ])->first();
    
    if ($like) {
        $upvoted = true;
    }
    ?>
<x-app-layout>
    <table class="table1 space">
        <tr>
            <td>
                <table class="table1 space">
                    <tr>
                        <td style="vertical-align: center; text-align:center;">
                            <form action="{{ route('posts.upvote', auth()->user()->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="post_id" value="{{$posts->id}}">
                                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                <a href="#" onclick="event.preventDefault(); this.closest('form').submit()" class="<?php if ($upvoted) { echo 'green'; } ?>">UP</a>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: center; text-align: center;">
                            <?php
                                if ($posts->likeables) {
                                  $likes = count($posts->likeables);
                                } else {
                                  $likes = 0;
                                }
                                echo $likes;
                                ?>
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
        <tr>
            <td><a href="{{route('users.show', ['id' =>$comment->user->id])}}"><img src="{{ $comment->user->profile_picture}}"></a></td>
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
            </td>
        </tr>
        @endforeach
        <td></td>
        <td>
            <form action="{{ route('posts.store', auth()->user()->id) }}" method="POST">
                @csrf
                <input type="hidden" name="post_id" value="{{ $posts->id }}">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <textarea style="textarea" name="content" rows="3" placeholder="Add a comment..." required></textarea>
                <br>
        <td>
        <button type="submit" class="btn btn-primary">Comment</button></td>
        </form>
        </td>
    </table>
    <br></br>
</x-app-layout>
<script>
    function upvote() {
      // Make an HTTP POST request to the server
      var xhr = new XMLHttpRequest();
      xhr.open('POST', '{{ route('posts.upvote', $posts->id)}}');
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onload = function() {
        if (xhr.status === 200) {
          // Update the like count on the page
          var response = JSON.parse(xhr.responseText);
          document.getElementById('like-count').innerHTML = response.likeCount;
        }
      };
      xhr.send('post_id={{ $posts->id }}&user_id={{ auth()->user()->id }}');
    }
</script>