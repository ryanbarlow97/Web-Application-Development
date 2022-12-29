<div>
  <!-- Use a button element to display the delete button -->
<button class="text-xs" wire:click="deleteComment">Delete</button>

<!-- Add a Livewire event listener to handle the deletion of comments -->
<script>
  window.livewire.on('commentDeleted', commentId => {
    // Find the list-group-item element that contains the data-comment-id attribute with the matching value
    const commentElement = document.querySelector(`[data-comment-id="${commentId}"]`);

    // Delete the comment element from the DOM
    commentElement.remove();
  });
</script>
</div>
