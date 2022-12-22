<style>
    table.table1 {
    margin: auto;
    width: 45%;
    }
    table.table1 td {
    width: 50px;
    }
    table.table1 td+td {
    width: fit-content;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.25);
    padding: 5px;
    margin: auto;
    }
    .space {
    border-collapse:separate;
    border-spacing:0 10px;
    }
    table.table2 {
    margin: auto;
    width: 50%;
    text-align: center;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ ucfirst(strtolower($user->first_name)) }} {{ ucfirst(strtolower($user->last_name)) }}
        </h2>
        <table class = "table2">
            <tr>
                <td>
                    <x-responsive-nav-link :href="route('users.posts', ['id' => $user->id])" :active="request()->routeIs('users.posts')">
                        {{ __('Posts') }}
                    </x-responsive-nav-link>
                </td>
                <td>
                    <x-responsive-nav-link :href="route('users.comments', ['id' => $user->id])" :active="request()->routeIs('users.comments')">
                        {{ __('Comments') }}
                    </x-responsive-nav-link>
                </td>
                <td>
                    <x-responsive-nav-link :href="route('users.liked_posts', ['id' => $user->id])" :active="request()->routeIs('users.liked_posts')">
                        {{ __('Liked Posts') }}
                    </x-responsive-nav-link>
                </td>
                <td>
                    <x-responsive-nav-link :href="route('users.liked_comments', ['id' => $user->id])" :active="request()->routeIs('users.liked_comments')">
                        {{ __('Liked Comments') }}
                    </x-responsive-nav-link>
                </td>
                </div>
                </div>
            </tr>
        </table>
    </x-slot>
    @foreach ($user->comments as $comment)
    <table class = "table1 space">
    <tr>
        <td>
            <a href="{{route('users.show', ['id' => $user->id])}}"><img src="{{ $user->profile_picture}}" style="width:42px;height:42px;"></a>
        </td>
        <td>
            {{ $comment->content}}
        </td>
    </tr>
    <table>
    @endforeach
</x-app-layout>