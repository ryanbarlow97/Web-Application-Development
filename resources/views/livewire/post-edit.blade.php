<div>
    <!-- Use a button element to display the delete button -->
    <button class="mr-2 text-xs" wire:click="$editMode ? setSection('editPost') : setSection('savePost')">
        {{ $editMode ? 'Edit' : 'Save' }}
    </button>

    <script>
    window.livewire.on('postEdited', postId => {
        const commentElement = document.querySelector(`[data-post-id="${postId}"]`);
    });
    </script>
</div>
