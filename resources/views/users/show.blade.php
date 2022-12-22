<style>
table {
  margin: auto;
  width: 45%;
}

td {
  width: 50px;
}
td+td {
  width: fit-content;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.25);
  padding: 5px;
  margin: auto;
}
.gfg {
    border-collapse:separate;
    border-spacing:0 10px;
}


</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ ucfirst(strtolower($users->first_name)) }} {{ ucfirst(strtolower($users->last_name)) }}
        </h2>
    </x-slot>
    
    
        
@foreach ($users->posts as $post)
    <table class = "gfg">
        <tr>
            <td>
                <a href="{{ $users->id}}"><img src="{{ $users->profile_picture}}" alt="HTML tutorial" style="width:42px;height:42px;"></a>
            </td>
            <td>
                {{ $post->content}}
            </td>
        </tr>
    <table>
@endforeach

    
</x-app-layout>