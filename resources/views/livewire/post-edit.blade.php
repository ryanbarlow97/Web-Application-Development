<div>
    <!-- Use a button element to display the delete button -->
    <button class="mr-2 text-xs pb-1" wire:click="{{ $editMode!='editPost' ? 'setEdit' : 'setSave'}}">
        {{ $editMode!='editPost' ? 'Edit' : 'Save' }}
    </button>
    
    <script>
    window.livewire.on('editing', postId => {
        const parentElement = document.querySelector(`[data-post-edit-id="post-edit-${postId}"]`);
        console.log(parentElement);
        // Create an edit box using JavaScript
        const editBox = document.createElement('input');
        editBox.type = 'text';
        editBox.value = parentElement.innerHTML;
        editBox.setAttribute('id', `post-edit-box-${postId}`);

        // Clear the existing content of the parent element
        parentElement.innerHTML = "";
        parentElement.appendChild(editBox);
    });

    window.livewire.on('saved', postId => {
        const parentElement = document.querySelector(`[data-post-edit-id="post-edit-${postId}"]`);

        const editBox = document.querySelector(`#post-edit-box-${postId}`);
        const content = editBox.value;

        parentElement.removeChild(editBox);
        parentElement.innerHTML = content;
        
        window.livewire.emit('editPost', ({content}));
    });

    </script>
</div>
