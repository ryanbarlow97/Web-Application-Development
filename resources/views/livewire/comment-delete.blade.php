<div>
    <button wire:click="deleteComment" class="btn btn-danger">Delete</button>

        <script>
            Livewire.on('commentDeleted', commentId => {
                document.getElementById("comment-{{ $commentId }}").remove();
            })
        </script>
</div>