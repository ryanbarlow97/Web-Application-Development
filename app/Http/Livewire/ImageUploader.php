<?php
  
namespace App\Http\Livewire;
  
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;
use Livewire\WithFileUploads;


class ImageUploader extends Component
{
    use WithFileUploads;

    public $photo;
    public $path;
    public $delete = false;



    public function save()
    {
        if ($this->delete) {
            $this->photo = null;
            $this->delete = false;
        }

        $this->validate([
            'photo' => ['sometimes', 'image'], // 12MB Max
        ]);
 
        $path = $this->photo->store('posts');

        // Save the image path to the database
        $image = new Image;
        $image->path = $path;
        $image->save();

    }

    public function removeImage()
    {
        $this->delete = true;
        $this->photo = null;
    }

}


        