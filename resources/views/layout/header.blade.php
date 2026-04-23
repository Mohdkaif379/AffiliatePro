<header
    id="header"
    class="fixed left-64 top-0 right-0 z-20 flex h-24 items-center justify-between border-b border-slate-200 bg-white px-4 text-slate-900 shadow-sm transition-all duration-300 md:px-6">

    <button
        id="sidebarMobileToggle"
        type="button"
        class="rounded-xl border border-slate-200 p-2 text-slate-700 transition hover:bg-slate-100 hover:text-slate-900 md:hidden"
        aria-label="Open sidebar">
        <i class="fas fa-bars"></i>
    </button>

    <div class="ml-4 hidden flex-1 items-center gap-4 md:flex">
        <div class="shrink-0">
            <span class="text-lg font-bold tracking-wide text-slate-900 lg:text-xl">
                Affiliate Programme
            </span>
        </div>

        <div class="relative w-full max-w-md">
            <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-400">
                <i class="fas fa-search text-sm"></i>
            </span>
            <input
                type="text"
                name="search"
                placeholder="Search..."
                class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-3 pl-11 pr-4 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-200">
        </div>
    </div>

    <div class="ml-auto relative flex items-center gap-3">
        <button
            type="button"
            class="relative flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-slate-50 text-slate-700 transition hover:bg-slate-100"
            aria-label="Notifications">
            <i class="fas fa-bell"></i>
            <span class="absolute right-0 top-0 h-2.5 w-2.5 rounded-full bg-red-500 ring-2 ring-white"></span>
        </button>

        <span class="hidden text-sm font-medium text-slate-500 sm:inline">
            {{ session('full_name') ?? 'Guest' }}
        </span>

        <button
            id="userDropdownToggle"
            type="button"
            class="flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-slate-50 text-slate-700 transition hover:bg-slate-100">
            <i class="fa fa-angle-down"></i>
        </button>

        <div
            id="userDropdown"
            class="absolute right-0 top-full mt-3 hidden w-52 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl">
            <div class="py-2">
                <a href="{{ route('profile') }}" class="flex items-center px-4 py-3 text-sm text-slate-700 hover:bg-slate-100">
                    <i class="fas fa-user mr-3 text-slate-400"></i> Profile
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-sm text-slate-700 hover:bg-slate-100">
                    <i class="fas fa-cog mr-3 text-slate-400"></i> Settings
                </a>
                <div class="my-2 border-t border-slate-200"></div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex w-full items-center px-4 py-3 text-sm text-slate-700 hover:bg-slate-100">
                        <i class="fas fa-sign-out-alt mr-3 text-slate-400"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
