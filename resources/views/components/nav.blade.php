<nav class="border-b border-gray-200 bg-white">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 justify-between">
        <div class="flex">
          <div class="flex flex-shrink-0 items-center">
          </div>
          <div class="-my-px ml-6 flex space-x-8">
            <x-nav-link route="dashboard">Dashboard</x-nav-link>
            <x-nav-link route="venues">Venues</x-nav-link>
            <x-nav-link route="users">Users</x-nav-link>
          </div>
        </div>
        <div class="ml-6 flex items-center">
          <x-profile-dropdown>
            <x-slot name="trigger">
                <button type="button" class="flex max-w-xs items-center rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                    <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                </button>
            </x-slot>
                <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-slate-500/10 transition" role="menuitem" tabindex="-1" id="user-menu-item-1">My Profile</a>
                <a href="/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-slate-500/10 transition" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
            </x-profile-dropdown>
          </div>
        </div>

      </div>
    </div>
  </nav>
