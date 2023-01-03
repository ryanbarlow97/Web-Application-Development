<div>
    <form wire:submit.prevent="store">
        @csrf
        <div>
            <div class="text-gray-800 text-md float-right"> 
                @if ($photo)
                <div class="relative">
                    <button class="bg-blue-500 rounded-xl px-5 py-2 hover:bg-blue-700 active:bg-blue-700"> Save </button>
                </div>
                @endif   
                @if (!$photo)
                <label for="file-input" class="btn btn-primary focus:outline-none">
                <p class="bg-blue-500 rounded-xl px-5 py-2 hover:bg-blue-700 active:bg-blue-700">
                    Change
                </p>
                </label> 
                <input id="file-input" type="file" style="display: none;" wire:model="photo" />
                @endif  
            </div>
            @error('photo') <span class="error">{{ $message }}</span> @enderror
        </div>
    </form>
</div>
