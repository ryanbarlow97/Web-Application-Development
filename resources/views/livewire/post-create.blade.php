<div>
  <div class="mx-auto items-center rounded-xl px-5 py-4 shadow-xl bg-white">
    <form wire:submit.prevent="store">
        @csrf
        <div class="flex justify-between rounded-md shadow-sm">
            <input wire:model.lazy="content" name="content" type="text" placeholder="What's on your mind?" required class="form-control rounded-md shadow-sm flex-1 focus:outline-none focus:ring-blue-700 focus:border-blue-700 w-full py-2 px-4 mr-2">
            <button type="submit" class="btn btn-primary rounded-md shadow-sm py-2 px-4 bg-blue-500 hover:bg-blue-700 active:bg-blue-700 focus:outline-none">Submit Post</button>
        </div>
        <div id="image-preview"></div>

        <div class="pt-2">
            <label for="file-input" class="btn btn-primary focus:outline-none">
                <img src="{{asset('/images/media.png')}}" width="30" height="30">
            </label>                
            <input id="file-input" type="file" style="display: none;" onchange="previewImage(this)"  />
        </div>
      </form>
  </div>
</div>

<script>
  function previewImage(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        var img = document.createElement('img');
        img.src = e.target.result;
        img.classList.add('my-2', 'object-fill', 'w-3/6', 'mx-auto');
        document.getElementById('image-preview').appendChild(img);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
