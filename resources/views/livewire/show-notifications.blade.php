<div>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
  @livewireScripts
  
  <div class="container mx-auto max-w-md py-2">

    @if (auth()->user()->notifications->isEmpty())
    <div class="card-body py-1 w-full rounded-xl text-center">
        <div class="px-4 py-4 rounded-xl bg-white shadow-xl">
          <p class="text-base font-bold"> Nothing to see here. </p>
        </div>
      </div>
    @endif
    <!-- Use a loop to display the notifications -->
    @foreach (auth()->user()->notifications as $notification)
      <button class="card-body py-1 w-full rounded-xl text-left" data-notification-id="{{ $notification->id }}" wire:click.stop="goToPost({{ $notification->data['post_id'] }})">
        <div class="px-4 py-4 rounded-xl bg-white hover:bg-blue-50 active:bg-blue-50 shadow-xl">
          <p class="text-base font-bold">{{ $notification->data['message'] }}</p>
          <p class="text-sm text-gray-700">{{ $notification->created_at->diffForHumans() }}
          @if ($notification->read_at != NULL)
           (seen)
          @endif
          </p>
        </div>
      </button>
    @endforeach
  </div>
</div>

