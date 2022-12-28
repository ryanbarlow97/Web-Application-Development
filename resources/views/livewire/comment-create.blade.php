<div>
    <!-- Use a Bootstrap form to style the comment form -->
    <form wire:submit.prevent="store" class="form-inline">
    <!-- Use a Bootstrap input group to style the comment input and button -->
    <div class="input-group w-100 px-3">
        <!-- Use the form-control class to style the comment input -->
        @csrf
        <input wire:model.lazy="content" name="content" type="text" class="form-control px-3 py-2 rounded-lg w-full" placeholder="Add a comment..." required>
        <!-- Use the btn and btn-primary classes to style the comment button -->
        <div class="px-3">
            <button type="submit" class="btn btn-primary">Comment</button>
        </div>
    </div>
    </form>
</div>
