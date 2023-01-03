<style>

.popout-box {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  border: 1px solid gray;
  display: none;
}

.popout-box.visible {
  display: block;
}


</style>

<div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
    @livewireScripts
    <x-slot name="header">
    <!-- Use Tailwind classes to style the header -->
    <div class="py-0 px-6 bg-white-200">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            User Settings
        </h2>
    </div>
    </x-slot>
    <div class="container mx-auto max-w-3xl w-full py-2 flex">

        <div class="mx-auto items-center rounded-xl px-5 py-4 w-full shadow-xl bg-white">
            <div class="text-xl"> 
                Account Settings 
            </div>
            <br>
            <div class="text-gray-800 text-xs border-b"> 
                Account Preferences
            </div>
            <br>
            <div class="text-gray-800 text-md"> 
                <div class="float-left">
                    Change Profile Picture
                    <div class="text-xs text-gray-500">
                        <img class="w-24 h-24 rounded-full" src="{{ asset('storage/'.Auth::user()->profile_picture) }}">
                    </div>
                </div>
            </div>
          <livewire:profile-picture-edit />
        </div>
    </div>
</div>

<div class="popout-box mx-auto max-w-sm py-2 px-2 border-blue-500 rounded-xl bg-white w-full" id="popoutEmail">
  <div class="text-xl font-semibold text-gray-800 leading-tight">
    Change Email
  </div>
  <br>
  <div class="text-gray-800 mx-auto text-md text-center">
    Current Password
    <input type="password" class="border w-full rounded-3xl px-3 py-2" wire:model="currentPassword">
  </div>
  <br>
  <div class="text-gray-800 mx-auto text-md text-center">
    New Email
    <input type="text" class="border w-full rounded-3xl px-3 py-2" wire:model="newEmail">
  </div>
  <br>
  <div class="float-right">
    <button class="bg-blue-500 rounded-xl px-5 py-2 hover:bg-blue-700 active:bg-blue-700" wire:click.stop="editEmail({{ auth()->user()->id }})">
      Save
    </button>
    <button class="bg-blue-500 rounded-xl px-5 py-2 hover:bg-blue-700 active:bg-blue-700" id="cancelEmail">
      Cancel
    </button>
  </div>
</div>


<div class="popout-box mx-auto max-w-md py-2 px-2 border-blue-500 rounded-xl bg-white w-full" id="popoutPassword">
  <div class="text-xl font-semibold text-gray-800 leading-tight">
    Change Email
  </div>
  <br>
  <div class="text-gray-800 mx-auto text-md text-center">
    Current Password
    <input type="password" class="border w-full rounded-3xl px-3 py-2" wire:model="currentPassword">
  </div>
  <br>
  <div class="text-gray-800 mx-auto text-md text-center">
    New Password
    <input type="text" class="border w-full rounded-3xl px-3 py-2" wire:model="newPassword">
  </div>
  <div class="text-gray-800 mx-auto text-md text-center">
    New Password Confirm
    <input type="text" class="border w-full rounded-3xl px-3 py-2" wire:model="newPassword">
  </div>
  <br>
  <div class="float-right">
    <button class="bg-blue-500 rounded-xl px-5 py-2 hover:bg-blue-700 active:bg-blue-700" wire:click.stop="editEmail({{ auth()->user()->id }})">
      Save
    </button>
    <button class="bg-blue-500 rounded-xl px-5 py-2 hover:bg-blue-700 active:bg-blue-700" id="cancelPassword">
      Cancel
    </button>
  </div>
</div>

<script>
    // Get the change button and the popout box
    var editEmail = document.getElementById('change-email');
    var cancelEmail = document.getElementById('cancelEmail');
    var popoutBox1 = document.getElementById('popoutEmail');

    editEmail.addEventListener("click", () => {
        popoutBox1.classList.toggle("visible");
        popoutBox2.classList.remove("visible");
    });

    cancelEmail.addEventListener("click", () => {
        popoutBox1.classList.remove("visible");
    });

    // Get the change button and the popout box
    var editPassword = document.getElementById('change-password');
    var cancelPassword = document.getElementById('cancelPassword');
    var popoutBox2 = document.getElementById('popoutPassword');
    editPassword.addEventListener("click", () => {
        popoutBox2.classList.toggle("visible");
        popoutBox1.classList.remove("visible");
    });

    cancelPassword.addEventListener("click", () => {
        popoutBox2.classList.remove("visible");
    });
</script>