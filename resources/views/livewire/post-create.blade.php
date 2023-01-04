<div>
    <div class="mx-auto items-center rounded-xl px-5 py-4 shadow-xl bg-white">
        <form wire:submit.prevent="store">
            @csrf
            <div class="flex justify-between rounded-md shadow-sm">
                <input wire:model.lazy="content" name="content" type="text" placeholder="What's on your mind?" required class="form-control rounded-md shadow-sm flex-1 focus:outline-none focus:ring-blue-700 focus:border-blue-700 w-full py-2 px-4 mr-2">
                <button type="submit" class="btn btn-primary rounded-md shadow-sm py-2 px-4 bg-blue-500 hover:bg-blue-700 active:bg-blue-700 focus:outline-none">Submit Post</button>
            </div>
            <div>
                @if ($photo)
                    @if (strpos($photo->getMimeType(), 'image/') === 0)
                    <div class="relative">
                        <img class="max-h-96 mx-auto items-center rounded-xl mt-3 shadow-xl" src="{{ $photo->temporaryUrl() }}">
                        <button class="delete-button absolute top-0 right-0 m-2 focus:outline-none" wire:click.prevent="removeImage">
                        x
                        </button>
                    </div>
                    @else
                    Make sure the image is png/jpeg/jpg/gif.

                    @endif
                @endif
                <div class="flex">
                    <!-- File Input -->          
                    <div class="pt-2 flex w-30 h-30 pr-2">
                        <label for="file-input" class="btn btn-primary focus:outline-none cursor-pointer">
                        <img src="{{asset('/images/media.png')}}" width="30" height="30">
                        </label>               
                        <input id="file-input" type="file" style="display: none;" wire:model.lazy="photo" />
                    </div>
                    @error('photo') <span class="error">{{ $message }}</span> @enderror

                    <!-- Top Twitch Stream -->          
                    <div class="pt-2 flex w-30 h-30">
                        <label for="twitch" class="btn btn-primary focus:outline-none cursor-pointer">
                        <img src="{{asset('/images/twitch.png')}}" width="30" height="30">
                        </label>                
                        <button id="twitch" wire:click.prevent="addTopTwitchVideo"></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>