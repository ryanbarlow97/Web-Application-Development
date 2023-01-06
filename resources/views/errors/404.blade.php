<head>
  <title>404 Not Found</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
  @livewireScripts
</head>
<body class="bg-gray-200 h-screen font-sans flex items-center justify-center">
  <div class="container mx-auto max-w-xl py-2">
    <div class="card-body py-1 w-full rounded-xl text-left">
      <div class="px-5 pt-5 flex rounded-xl bg-white shadow-xl">
        <div class="flex flex-col items-center w-full">
          <h1 class="text-2xl font-bold text-red-600">Oops!</h1>
          <h2 class="text-xl font-semibold text-gray-700">404 Not Found</h2>
          <div class="text-gray-700 text-sm mt-4">
            Sorry, an error has occured, Requested page not found! It may have been deleted.
          </div>
          <div class="mt-4 btn btn-primary btn-lg">
            <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-nav-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>