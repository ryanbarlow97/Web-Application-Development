<!-- Use the container class to center the content -->
<div class="container">
  <!-- Use the form-group class to style the form group -->
  <form wire:submit.prevent="store" class="mb-6">
    <!-- Use the flex class to align the elements horizontally -->
    <div class="flex items-center rounded-md">
      <!-- Use the form-control class to style the comment input -->
      @csrf
      <!-- Use the btn and btn-primary classes to style the comment button -->
      <div>
        <input wire:model.lazy="content" name="content" type="text" placeholder="Add a comment..." required class="form-control rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 py-2 px-4">
        <button type="submit" class="btn btn-primary rounded-md shadow-sm py-2 px-4 bg-blue-500 hover:bg-blue-700 active:bg-blue-700 focus:outline-none">Comment</button>
      </div>
    </div>
  </form>
</div>
