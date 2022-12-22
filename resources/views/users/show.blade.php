
<style>
table.table2 {
  margin: auto;
  width: 50%;
  text-align: center;
}
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ ucfirst(strtolower($users->first_name)) }} {{ ucfirst(strtolower($users->last_name)) }}
        </h2>
        <table class = "table2">
            <tr>
                <td>
                    <x-responsive-nav-link :href="route('users.posts', ['id' => $users->id])" :active="request()->routeIs('users.posts')">
                        {{ __('Posts') }}
                    </x-responsive-nav-link>
                </td>
                <td>
                    <x-responsive-nav-link :href="route('users.comments', ['id' => $users->id])" :active="request()->routeIs('users.comments')">
                        {{ __('Comments') }}
                    </x-responsive-nav-link>
                </td>
                <td>
                    <x-responsive-nav-link :href="route('users.liked_posts', ['id' => $users->id])" :active="request()->routeIs('users.liked_posts')">
                        {{ __('Liked Posts') }}
                    </x-responsive-nav-link>
                </td>
                <td>
                    <x-responsive-nav-link :href="route('users.liked_comments', ['id' => $users->id])" :active="request()->routeIs('users.liked_comments')">
                        {{ __('Liked Comments') }}
                    </x-responsive-nav-link>
                </td>
            </div>
            </div>
            </tr>
        </table>
    </x-slot>
</x-app-layout>