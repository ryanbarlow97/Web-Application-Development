<style>
.comment-box {
    background-color: lightblue;
    padding: 10px;
    margin: auto;
    width: 100%;
}

table {
  table-layout: fixed;
  margin: auto;
  border-collapse: collapse;
  width: 60%;
}
td {
  border: 1px solid #000;
  width: 75px;
}
td+td {
  width: fit-content;
}

</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ ucfirst(strtolower($users->first_name)) }} {{ ucfirst(strtolower($users->last_name)) }}
        </h2>
    </x-slot>
    
    <table>
        <br>
        @foreach ($users->posts as $post)
            <tr>
                <td>
                {{ $users->profile_picture}}
                </td>
                <td>
                    <div class="comment-box">
                       {{ $post->content}}
                    </div>
                </td>
            </tr>
        @endforeach
    <table>
    
</x-app-layout>