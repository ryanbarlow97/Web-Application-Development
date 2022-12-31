<div>
    <form wire:submit.prevent="save">
        @if ($photo)
            <div class="relative">
                <img class="max-h-96 mx-auto items-center rounded-xl mt-3 shadow-xl" src="{{ $photo->temporaryUrl() }}">
                <button class="delete-button absolute top-0 right-0 m-2 focus:outline-none" wire:click="removeImage">
                    x
                </button>
            </div>
        @endif

        <!-- File Input -->          
        <div class="pt-2">
            <label for="file-input" class="btn btn-primary focus:outline-none">
                <img src="{{asset('/images/media.png')}}" width="30" height="30">
            </label>                
            <input id="file-input" type="file" style="display: none;" wire:model.lazy="photo" />
        </div>

        @error('photo') <span class="error">{{ $message }}</span> @enderror
    </form>
</div>
