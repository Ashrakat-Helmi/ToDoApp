<div class="sidebar">
  <a>
      {{ Auth::user()->name }}
    </a>
  <br>
 
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
    {{ __('Dashboard') }}
    </x-nav-link>
  <br>

    <x-nav-link :href="route('Tasks.index')" :active="request()->routeIs('Tasks.index')">
    {{ __('Tasks') }}
    </x-nav-link>
  <br>

 
    <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
      {{ __('Profile') }}
    </x-nav-link>
  <br>
 
    <form method="POST" action="{{ route('logout') }}">
    @csrf

    <x-dropdown-link :href="route('logout')"
            onclick="event.preventDefault();
                        this.closest('form').submit();">
        {{ __('Log Out') }}
    </x-dropdown-link>
    </form>
  <br>
</div>

