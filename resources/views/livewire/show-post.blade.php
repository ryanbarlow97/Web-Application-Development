<div>
<head>
    <!-- Add a Twitter Bootstrap CDN to your head section -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
<!-- Add the Livewire scripts -->
@livewireScripts
<div class="container mx-auto">
    <div class="card mb-3">
        <div class="card-body">
            <div class="flex">
                <img src="{{ $post->user->profile_picture }}" class="mr-3 rounded-full w-10 h-10">
                <div class="media-body">
                    <h5 class="mt-0 mb-0 font-bold">
                        <a href="{{ route('users.show', $post->user) }}">{{ $post->user->first_name }} {{ $post->user->last_name }}</a>
                    </h5>
                    <small class="text-gray-600">{{ $post->created_at->diffForHumans() }}</small>
                    <p class="card-text">{{ $post->content }}</p>
                    <livewire:upvote :likeableType="'App\\Models\\Post'" :likeableId="$post->id"/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <livewire:comment-create :post_id="$post->id" />
        </div>
        <livewire:show-comments :post="$post" />
    </div>
</div>
</body>
</div>