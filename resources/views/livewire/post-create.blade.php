<div>

  <div class="mx-auto items-center rounded-xl px-5 py-4 shadow-xl bg-white">
    <form wire:submit.prevent="store">
        @csrf
        <div class="flex justify-between rounded-md shadow-sm">
            <input wire:model.lazy="content" name="content" type="text" placeholder="What's on your mind?" required class="form-control rounded-md shadow-sm flex-1 focus:outline-none focus:ring-blue-700 focus:border-blue-700 w-full py-2 px-4 mr-2">
            <button type="submit" class="btn btn-primary rounded-md shadow-sm py-2 px-4 bg-blue-500 hover:bg-blue-700 active:bg-blue-700 focus:outline-none">Submit Post</button>
        </div>    

        <livewire:image-uploader />
        
      </form>
  </div>
</div>