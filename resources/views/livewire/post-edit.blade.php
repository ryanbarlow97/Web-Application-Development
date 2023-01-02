<div class="flex items-center justify-between -ml-2">
    <div class="flex items-center justify-between w-full" x-data="{ isEditing: false, focus: function() { const textInput = this.$refs.textInput; textInput.focus(); textInput.select(); } }" x-cloak>
        <div class="p-2" x-show="!isEditing">
            <span class="border-b border-dashed border-gray-500" x-on:click="isEditing = true; $nextTick(() => focus())">{{ $origContent }}</span>
        </div>
        <div x-show="isEditing" class="flex flex-col w-full">
            <form class="flex pt-2" wire:submit.prevent="save">
                <input type="text" class="px-2 border border-gray-400 w-full rounded-lg" placeholder="100 characters max." x-ref="textInput" wire:model.lazy="newContent" x-on:keydown.enter="isEditing = false" x-on:keydown.escape="isEditing = false">
            </form>
            <small class="text-xs ml-2 mb-2">Press enter to save or esc to cancel.</small>
        </div>
    </div>
</div>
