<head> 
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
@livewireStyles

</head>
<body>
    @livewireScripts
    <x-app-layout>
        <table class="table1 space">
            <tr>
                <td>
                    <table class="table1 space">
                        <tr>
                            <td style="vertical-align: center; text-align:center;">
                                @livewire('upvote', ['likeableType' => 'App\\Models\\Post', 'likeableId' => $posts->id])
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
            <tr id="comment-{{ $comment->id }}">
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
                                @livewire('upvote', ['likeableType' => 'App\\Models\\Comment', 'likeableId' => $comment->id])
                            @endif
                        </td>
                        <td style="text-align:right;">
                            @if ($comment->user_id == auth()->user()->id)
                                @livewire('comment-delete',  ['commentId' => $comment->id])
                            @endif
                        </td>
                    </table>
                </td>
            </tr>
            @endforeach
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
</body>