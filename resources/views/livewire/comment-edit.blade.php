<div>
    <script src="/js/comment-edit.js"></script>
    <!-- Use a button element to display the delete button -->
    <button class="mr-2 text-xs pb-1" wire:click="{{ $editMode!='editComment' ? 'setEdit' : 'setSave'}}">
        {{ $editMode!='editComment' ? 'Edit' : 'Save' }}
    </button>
</div>
