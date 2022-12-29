<div>
  <!-- Use a button element to display the delete button -->
<button class="text-xs pb-5" wire:click="deletePost">Delete</button>

<!-- Add a Livewire event listener to handle the deletion of comments -->
<script>
  window.livewire.on('postDeleted', postId => {
    // Find the list-group-item element that contains the data-comment-id attribute with the matching value
    const postElement = document.querySelector(`[data-post-id="${postId}"]`);

    // Delete the comment element from the DOM
    postElement.remove();
  });
</script>
</div>
