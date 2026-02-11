@php
$userPermissions = \App\Models\UserPermission::where('user_id', auth()->id())->first();
$permissions = $userPermissions ? $userPermissions->permissions : [];
@endphp



<aside class="w-64 bg-gray-900  text-white fixed left-0 top-0 bottom-0 z-30 overflow-y-auto transition-all duration-300 hidden md:block" id="sidebar">

    <!-- Logo Section -->
    <div class="h-24 flex items-center justify-center border-b border-white/20">
        <img
            src="{{ asset('images/logo.png') }}"
            alt="Affiliate Program Logo"
            class="h-20 w-20 rounded-full object-cover border-2 border-yellow-600">
        <!-- <span id="logoText" class="ml-2 text-sm font-bold hidden md:block">Affiliate</span> -->
    </div>

    <!-- Menu -->
    <nav class="p-4 space-y-2">
        @if(isset($permissions['dashboard']) && in_array('read', $permissions['dashboard']))
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-700">
            <i class="fas fa-tachometer-alt  w-4"></i> <!-- Icon -->
            Dashboard
        </a>
        @endif

        @php
        $managementPerms = $permissions['management'] ?? [];
        @endphp
        @if(count($managementPerms) > 0)
        <!-- Dropdown Toggle -->
        <button
            class="w-full flex justify-between items-center px-4 py-2 rounded hover:bg-gray-700 focus:outline-none"
            onclick="toggleDropdown('managementDropdown', 'dropdownArrow-management')">
            <span class="flex items-center gap-2">
                <i class="fas fa-cogs w-4"></i> <!-- Icon -->
                NHI Access
            </span>
            <span id="dropdownArrow-management" class="transition-transform duration-200">▼</span>
        </button>

        <!-- Dropdown Menu -->
        <ul id="managementDropdown" class="ml-4 mt-1 hidden space-y-1">
            @if(in_array('read', $managementPerms))
            <li>
                <a href="{{route('admin.index')}}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-700">
                    <i class="fas fa-users w-4"></i> Users
                </a>
            </li>
            <li>
                <a href="{{route('roles.index')}}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-700">
                    <i class="fas fa-user-tag w-4"></i> Roles
                </a>
            </li>            
            <li>
                <a href="{{route('attendance.index')}}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-700">
                    <!-- <i class="fas fa-sliders-h w-4"></i> -->
                    <i class="fas fa-calendar-check w-4"></i> Attendence
                </a>
            </li>
            @endif
        </ul>
        @endif

        @php
        $offersPerms = $permissions['offers'] ?? [];
        @endphp

        @if(count($offersPerms) > 0)
        <button
            class="w-full flex justify-between items-center px-4 py-2 rounded hover:bg-gray-700 focus:outline-none"
            onclick="toggleDropdown('offersDropdown')">
            <span class="flex items-center gap-2">
                <i class="fas fa-cogs w-4"></i> <!-- Icon -->
                Offers
            </span>
            <span id="dropdownArrow-offers" class="transition-transform duration-200">▼</span>
        </button>

        <!-- Dropdown Menu -->
        <ul id="offersDropdown" class="ml-4 mt-1 hidden space-y-1">
            @if(in_array('read', $offersPerms))
            <li>
                <a href="{{route('offers.create')}}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-700">
                    <i class="fas fa-plus w-4"></i> Create Offer
                </a>
            </li>
            <li>
                <a href="{{route('offers.index')}}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-700">
                    <i class="fas fa-eye w-4"></i> Manage Offers
                </a>
            </li>
            <li>
                <a href="{{route('assigned_offers.index')}}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-700">
                    <i class="fas fa-handshake w-4"></i>Assigned Offers
                </a>
            </li>
            @endif
        </ul>
        @endif

        @php
        $reportsPerms = $permissions['reports'] ?? [];
        @endphp

        @if(count($reportsPerms) > 0)
        <!-- Reports Dropdown Toggle -->
        <button
            class="w-full flex justify-between items-center px-4 py-2 rounded hover:bg-gray-700 focus:outline-none"
            onclick="toggleDropdown('reportsDropdown', 'dropdownArrow-reports')">
            <span class="flex items-center gap-2">
                <i class="fas fa-chart-line w-4"></i> <!-- Icon -->
                Reports
            </span>
            <span id="dropdownArrow-reports" class="transition-transform duration-200">▼</span>
        </button>

        <!-- Dropdown Menu -->
        <ul id="reportsDropdown" class="ml-4 mt-1 hidden space-y-1">
            @if(in_array('read', $reportsPerms))
            <li>
                <a href="{{route('all.report')}}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-700">
                    <i class="fas fa-file-alt w-4"></i> General Reports
                </a>
            </li>
            <li>
                <a href="{{route('analytics.index')}}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-700">
                    <i class="fas fa-chart-bar w-4"></i> Analytics
                </a>
            </li>
            @endif
        </ul>
        @endif

        @php
        $dataManagementPerms = $permissions['dataManagement'] ?? [];
        @endphp

        @if(count($dataManagementPerms) > 0)
        <!-- Data Management Dropdown Toggle -->
        <button
            class="w-full flex justify-between items-center px-4 py-2 rounded hover:bg-gray-700 focus:outline-none"
            onclick="toggleDropdown('dataManagementDropdown', 'dropdownArrow-dataManagement')">
            <span class="flex items-center gap-2">
                <i class="fas fa-database w-4"></i> <!-- Icon -->
                Data Management
            </span>
            <span id="dropdownArrow-dataManagement" class="transition-transform duration-200">▼</span>
        </button>

        <!-- Dropdown Menu -->
        <ul id="dataManagementDropdown" class="ml-4 mt-1 hidden space-y-1">
            @if(in_array('read', $dataManagementPerms))
            <li>
                <a href="{{route('cities.index')}}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-700">
                    <i class="fas fa-city w-4"></i> City
                </a>
            </li>
            <li>
                <a href="{{route('states.index')}}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-700">
                    <i class="fas fa-map-marker-alt w-4"></i> State
                </a>
            </li>

            <li>
                <a href="{{route('countries.index')}}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-700">
                    <i class="fas fa-globe w-4"></i> Country
                </a>
            </li>
            <li>
                <a href="{{route('languages.index')}}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-700">
                    <i class="fas fa-language w-4"></i> Language
                </a>
            </li>
            @endif
        </ul>
        @endif


        @php
        $managersPerms = $permissions['managers'] ?? [];
        @endphp

        @if(count($managersPerms) > 0)
        <!-- Managers Dropdown Toggle -->
        <button
            class="w-full flex justify-between items-center px-4 py-2 rounded hover:bg-gray-700 focus:outline-none"
            onclick="toggleDropdown('managersDropdown', 'dropdownArrow-managers')">
            <span class="flex items-center gap-2">
                <i class="fas fa-users w-4"></i> <!-- Icon -->
                Managers
            </span>
            <span id="dropdownArrow-managers" class="transition-transform duration-200">▼</span>
        </button>

        <!-- Dropdown Menu -->
        <ul id="managersDropdown" class="ml-4 mt-1 hidden space-y-1">
            @if(in_array('read', $managersPerms))
            <li>
                <a href="{{route('manager.index')}}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-700">
                    <i class="fas fa-user w-4"></i> Managers
                </a>
            </li>
            <li>
                <a href="{{route('manager.offers')}}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-700">
                    <i class="fas fa-handshake w-4"></i> My Assigned Offers
                </a>
            </li>
            <li>
                <a href="{{route('manager.report')}}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-700">
                    <i class="fas fa-chart-bar w-4"></i> Reports
                </a>
            </li>
            @endif
        </ul>
        @endif

        @php
        $advertisersPerms = $permissions['advertisers'] ?? [];
        @endphp

        @if(count($advertisersPerms) > 0)
        <!-- Advertisers Dropdown Toggle -->
        <button
            class="w-full flex justify-between items-center px-4 py-2 rounded hover:bg-gray-700 focus:outline-none"
            onclick="toggleDropdown('advertisersDropdown', 'dropdownArrow-advertisers')">
            <span class="flex items-center gap-2">
                <i class="fas fa-ad w-4"></i> <!-- Icon -->
                Advertisers
            </span>
            <span id="dropdownArrow-advertisers" class="transition-transform duration-200">▼</span>
        </button>

        <!-- Dropdown Menu -->
        <ul id="advertisersDropdown" class="ml-4 mt-1 hidden space-y-1">
            @if(in_array('read', $advertisersPerms))
            <li>
                <a href="{{route('advertiser.index')}}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-700">
                    <i class="fas fa-user w-4"></i> Advertiser
                </a>
            </li>
            <li>
                <a href="{{route('advertiser.offers')}}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-700">
                    <i class="fas fa-handshake w-4"></i> My Assigned Offers
                </a>
            </li>
            <li>
                <a href="{{route('advertiser.report')}}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-700">
                    <i class="fas fa-chart-bar w-4"></i> Reports
                </a>
            </li>
            @endif
        </ul>
        @endif

        @php
        $hrPerms = $permissions['hr'] ?? [];
        @endphp

        @if(count($hrPerms) > 0)

        <!-- HR Dropdown Toggle -->
        <button
            class="w-full flex justify-between items-center px-4 py-2 rounded hover:bg-gray-700 focus:outline-none"
            onclick="toggleDropdown('hrDropdown', 'dropdownArrow-hr')">
            <span class="flex items-center gap-2">
                <i class="fas fa-user-friends w-4"></i> <!-- Icon -->
                HR
            </span>
            <span id="dropdownArrow-hr" class="transition-transform duration-200">▼</span>
        </button>

        <!-- Dropdown Menu -->
        <ul id="hrDropdown" class="ml-4 mt-1 hidden space-y-1">
            @if(in_array('read', $hrPerms))
            <li>
                <a href="{{route('hr.index')}}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-700">
                    <i class="fas fa-user w-4"></i> HR
                </a>
            </li>
            <li>
                <a href="{{route('hr.offers')}}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-700">
                    <i class="fas fa-handshake w-4"></i> My Assigned Offers
                </a>
            </li>
            <li>
                <a href="{{route('hr.report')}}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-700">
                    <i class="fas fa-chart-bar w-4"></i> Reports
                </a>
            </li>
            @endif
        </ul>
        @endif

        @php
        $employeePerms = $permissions['employee'] ?? [];
        @endphp

        @if(count($employeePerms) > 0)
        <!-- Employee Dropdown Toggle -->
        <button
            class="w-full flex justify-between items-center px-4 py-2 rounded hover:bg-gray-700 focus:outline-none"
            onclick="toggleDropdown('employeeDropdown', 'dropdownArrow-employee')">
            <span class="flex items-center gap-2">
                <i class="fas fa-user-tie w-4"></i> <!-- Icon -->
                Employee
            </span>
            <span id="dropdownArrow-employee" class="transition-transform duration-200">▼</span>
        </button>

        <!-- Dropdown Menu -->
        <ul id="employeeDropdown" class="ml-4 mt-1 hidden space-y-1">
            @if(in_array('read', $employeePerms))
            <li>
                <a href="{{route('employees.index')}}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-700">
                    <i class="fas fa-user w-4"></i> Employee
                </a>
            </li>
            <li>
                <a href="{{route('employee.offers')}}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-700">
                    <i class="fas fa-handshake w-4"></i> My Assigned Offers
                </a>
            </li>
            <li>
                <a href="{{route('employee.report')}}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-700">
                    <i class="fas fa-chart-bar w-4"></i> Reports
                </a>
            </li>
            @endif
        </ul>
        @endif

        @php
$accountsPerms = $permissions['accounts'] ?? [];
@endphp

@if(count($accountsPerms) > 0)
        <!-- Accounts Dropdown Toggle -->
        <button
            class="w-full flex justify-between items-center px-4 py-2 rounded hover:bg-gray-700 focus:outline-none"
            onclick="toggleDropdown('accountsDropdown', 'dropdownArrow-accounts')">
            <span class="flex items-center gap-2">
                <i class="fas fa-wallet w-4"></i> <!-- Icon -->
                Accounts
            </span>
            <span id="dropdownArrow-accounts" class="transition-transform duration-200">▼</span>
        </button>

        <!-- Dropdown Menu -->
        <ul id="accountsDropdown" class="ml-4 mt-1 hidden space-y-1">
             @if(in_array('read', $accountsPerms))
            <li>
                <a href="{{route('accountant.index')}}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-700">
                    <i class="fas fa-chart-pie w-4"></i>Accountant
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-700">
                    <i class="fas fa-credit-card w-4"></i>Billing Account
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-700">
                    <i class="fas fa-share w-4"></i>Referrals
                </a>
            </li>
            @endif
        </ul>
        @endif
    </nav>
</aside>