<div>
    <!-- Include the link to the stylesheet from the CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
    <!-- Add the Livewire scripts --> 
    @livewireScripts
    @if (!$conversations->isEmpty())
    <div class="flex flex-wrap px-2 py-2 justify-center" wire:poll.250ms>
        <div class="container max-w-xs mr-4 w-1/2">
            <div class="card-body w-full rounded-xl text-left">
                <ul class="rounded-xl bg-white shadow-xl">
                    @foreach ($conversations->sortBy('updated_at')->reverse() as $conversation)
                        <button class="card-body px-2 py-2 {{ $loop->first ? 'rounded-t-xl' : '' }} {{ $loop->last ? 'rounded-b-xl' : '' }} w-full hover:bg-blue-50 active:bg-blue-50 {{ $conversation->id == $selectedConversation->id ? 'bg-blue-100' : '' }}" wire:click.prevent="viewConversation({{ $conversation->id }})">
                            <div>
                                @if ($conversation->sender_id != Auth::user()->id)
                                    <div class="flex text-left">
                                        <img class="w-12 h-12 rounded-full" src="{{asset('/storage/'.$conversation->sender->profile_picture)}}"> 
                                        <div class="pl-3 w-full">
                                            {{$conversation->sender->first_name}} {{$conversation->sender->last_name}} 
                                            @if(!$conversation->messages->isEmpty())
                                                <br>
                                                <div class="text-gray-600 text-sm">
                                                    {{$conversation->messages->last()->content}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    
                                @else
                                <div class="flex text-left">
                                        <img class="w-12 h-12 rounded-full" src="{{asset('/storage/'.$conversation->recipient->profile_picture)}}"> 
                                        <div class="pl-3 w-full">
                                        {{$conversation->recipient->first_name}} {{$conversation->recipient->last_name}}
                                        @if(!$conversation->messages->isEmpty())
                                            <br>
                                            <div class="text-gray-600 text-sm">
                                                {{$conversation->messages->last()->content}}
                                            </div>
                                        @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </button>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="container max-w-3xl w-1/2">
            <div class="card-body w-full rounded-xl text-left">
                <ul class="rounded-xl bg-white shadow-xl text-center">
                @foreach ($selectedConversation->messages as $message)
                @if ($message->user->id === auth()->id())
                <div class="flex px-2 items-center py-2">
                    <img class="w-12 h-12 rounded-full mr-2" src="{{asset('/storage/'.$message->user->profile_picture)}}" title="{{ $message->created_at->diffForHumans() }}" alt="{{ $message->created_at->diffForHumans() }}"> 
                        <div>
                            You
                        </div>
                        <div class="items-center w-full text-right px-6">
                            {{ $message->content }}
                        </div>
                    </div>
                @else
                <div class="flex items-center px-2 py-2">
                    <img class="w-12 h-12 rounded-full mr-2" src="{{asset('/storage/'.$message->user->profile_picture)}}" title="{{ $message->created_at->diffForHumans() }}" alt="{{ $message->created_at->diffForHumans() }}">
                        <div>
                            {{ $message->user->first_name }}

                        </div>
                        <div class="items-center w-full text-right px-6">
                            {{ $message->content }}
                        </div>
                    </div>
                @endif
                @endforeach
                    <div class="card-body px-2 py-2 w-full rounded-xl text-left">
                        <form class="flex" wire:submit.prevent="sendMessage">
                                <input class="w-full rounded-xl" wire:model.defer="content" type="text" name="message" placeholder="Type Message and Press Enter" class="form-control">
                        </form>
                    </div>
                </ul>
            </div>
        </div>
    </div>
    @else
    <div class="card-body py-1 w-full mx-auto max-w-3xl rounded-xl text-center">
        <div class="px-4 py-4 rounded-xl bg-white shadow-xl">
          <p class="text-base"> To start a conversation, go to a user's profile and click "Begin Messaging". </p>
        </div>
    </div>
    @endif
</div>