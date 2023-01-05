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