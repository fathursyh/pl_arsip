@php
    $SIDEBAR_MENU = match (
        auth()
            ->user()
            ->hasAnyRole(['admin'])
    ) {
        true => [
            [
                'name' => 'Dashboard',
                'link' => 'admin.home',
                'icon' => 'home',
            ],
            [
                'name' => 'Arsip',
                'link' => 'arsip.index',
                'icon' => 'arsip',
            ],
            [
                'name' => 'Peminjaman',
                'link' => 'peminjaman.index',
                'icon' => 'pinjam',
            ],
            [
                'name' => 'Riwayat',
                'link' => 'admin.riwayat',
                'icon' => 'riwayat',
            ],
            [
                'name' => 'Users',
                'link' => 'admin.users',
                'icon' => 'users',
            ],
        ],
        false => [
            [
                'name' => 'Dashboard',
                'link' => 'user.home',
                'icon' => 'home',
            ],
            [
                'name' => 'Arsip',
                'link' => 'user.arsip',
                'icon' => 'arsip',
            ],
            [
                'name' => 'Peminjaman',
                'link' => 'user.peminjaman',
                'icon' => 'pinjam',
            ],
        ],
    };
@endphp
<button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button"
    class="ms-3 mt-2 inline-flex items-center rounded-lg p-2 text-sm text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 sm:hidden dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <svg class="h-6 w-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd"
            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
        </path>
    </svg>
</button>

<aside id="logo-sidebar"
    class="fixed left-0 top-0 z-40 h-screen w-64 -translate-x-full bg-gray-50 pt-6 transition-transform sm:translate-x-0"
    aria-label="Sidebar">
    <div class="flex h-full flex-col overflow-y-auto px-3 py-4">
        <a href="/" class="mb-5 flex items-center ps-2.5">
            <img src="https://flowbite.com/docs/images/logo.svg" class="me-3 h-6 sm:h-7" alt="Flowbite Logo" />
            <span class="self-center whitespace-nowrap text-xl font-semibold">Arsip Laili</span>
        </a>
        <ul class="space-y-2 font-medium">
            @foreach ($SIDEBAR_MENU as $menu)
                <li class="{{ request()->routeIs($menu['link']) ? 'bg-gray-200 rounded' : '' }}">
                    <a href="{{ route($menu['link']) }}"
                        class="group flex items-center rounded-lg p-2 text-gray-900 hover:bg-gray-100">
                        <x-sidebar-icons :icon="$menu['icon']" />
                        <span class="ms-3">{{ $menu['name'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
        <ul class="mt-4 space-y-2 border-t border-gray-200 pt-4 font-medium">
            <li>
                <form action="{{ route('auth.logout') }}" method="POST" class="w-full">
                    @method('POST')
                    @csrf
                    <button type="submit"
                        class="group flex w-full cursor-pointer items-center rounded-lg p-2 text-red-600 transition duration-75 hover:bg-gray-100">
                        <svg class="h-6 w-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M11.403 5H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-6.403a3.01 3.01 0 0 1-1.743-1.612l-3.025 3.025A3 3 0 1 1 9.99 9.768l3.025-3.025A3.01 3.01 0 0 1 11.403 5Z"
                                clip-rule="evenodd" />
                            <path fill-rule="evenodd"
                                d="M13.232 4a1 1 0 0 1 1-1H20a1 1 0 0 1 1 1v5.768a1 1 0 1 1-2 0V6.414l-6.182 6.182a1 1 0 0 1-1.414-1.414L17.586 5h-3.354a1 1 0 0 1-1-1Z"
                                clip-rule="evenodd" />
                        </svg>

                        <span class="ms-3">Keluar Akun</span>
                    </button>
                </form>
            </li>
        </ul>
        <div class="flex flex-1 items-end p-4">
            @php
                $initials = collect(explode(' ', auth()->user()->name))
                    ->map(fn($word) => strtoupper($word[0]))
                    ->take(2)
                    ->implode('');
            @endphp
            <div class="flex items-center gap-2.5">
                <div
                    class="bg-neutral-tertiary relative inline-flex h-10 w-10 items-center justify-center overflow-hidden rounded-full">
                    <span class="text-body font-medium">{{ $initials }}</span>
                </div>
                <div class="text-heading font-medium">
                    <div>{{ auth()->user()->name }}</div>
                    <div c  lass="text-body text-sm font-normal">{{ auth()->user()->nip }}</div>
                </div>
            </div>
        </div>
    </div>
</aside>
