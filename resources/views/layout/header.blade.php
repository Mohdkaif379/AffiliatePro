<header class="bg-gray-900 h-24 flex items-center justify-between px-4 md:px-6 text-white fixed top-0 left-64 right-0 z-20 border-b-4 border-yellow-600 transition-all duration-300" id="header">

    <!-- Left Side - Toggle Button -->
    <button id="sidebarToggle" class="text-white hover:bg-gray-800 p-2 rounded transition">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Right Side -->
    <div class="relative flex items-center gap-4">
        <!-- Session Email -->
        <span class="text-sm text-yellow-600">
            {{ session('full_name') ?? 'Guest' }}
        </span>

        <!-- User Icon Button -->
        <button id="userDropdownToggle" class="flex items-center justify-center w-10 h-10 rounded-full  transition">
            <i class="fa fa-angle-down text-yellow-600"></i>
        </button>
        <span><svg xmlns="http://www.w3.org/2000/svg" class="text-yellow-600" width="20" height="20" viewBox="0 0 24 24">
                <g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                    <path d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12m10-8a8 8 0 1 0 0 16a8 8 0 0 0 0-16" />
                    <path d="M13 7a1 1 0 1 0-2 0v4H7a1 1 0 1 0 0 2h4v4a1 1 0 1 0 2 0v-4h4a1 1 0 1 0 0-2h-4z" />
                </g>
            </svg></span>
        <span><svg xmlns="http://www.w3.org/2000/svg" class="text-yellow-600" width="20" height="20" viewBox="0 0 16 16">
                <path fill="currentColor" fill-rule="evenodd" d="M11.5 7a4.5 4.5 0 1 1-9 0a4.5 4.5 0 0 1 9 0m-.82 4.74a6 6 0 1 1 1.06-1.06l3.04 3.04a.75.75 0 1 1-1.06 1.06z" clip-rule="evenodd" stroke-width="0.5" stroke="currentColor" />
            </svg></span>

        <!-- Dropdown Menu -->
        <div id="userDropdown" class="absolute right-0 mt-48 w-48 bg-gray-900 shadow-lg z-50 hidden ">
            <div class="py-1">
                <a href="{{route('profile')}}" class="flex items-center px-4 py-2 text-sm text-white hover:text-yellow-500 hover:bg-gray-700">
                    <i class="fas fa-user mr-2"></i> Profile
                </a>
                <a href="#" class="flex items-center px-4 py-2 text-sm text-white hover:text-yellow-500 hover:bg-gray-700">
                    <i class="fas fa-cog mr-2"></i> Settings
                </a>
                <hr class="my-1 border-gray-700">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center px-4 py-2 text-sm text-white hover:text-yellow-500 hover:bg-gray-700">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

</header>