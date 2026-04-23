@php
    $userPermissions = \App\Models\UserPermission::where('user_id', auth()->id())->first();
    $permissions = $userPermissions ? $userPermissions->permissions : [];

    $navLinkBase = 'group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-700 transition-all duration-200 hover:bg-slate-100 hover:text-slate-900';
    $navButtonBase = 'group flex w-full items-center justify-between rounded-xl px-4 py-3 text-sm font-medium text-slate-700 transition-all duration-200 hover:bg-slate-100 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-200';
    $dropdownLinkBase = 'group flex items-center gap-3 rounded-lg px-4 py-2.5 text-sm text-slate-600 transition-colors duration-200 hover:bg-slate-100 hover:text-slate-900';
@endphp

<aside
    id="sidebar"
    data-collapsed="false"
    class="fixed left-0 top-0 bottom-0 z-30 hidden h-screen w-64 overflow-hidden border-r border-slate-200 bg-white text-slate-800 shadow-xl transition-all duration-300 md:flex md:flex-col">

    <div class="sidebar-brand relative flex h-24 flex-none items-center justify-center border-b border-slate-200 bg-gradient-to-b from-white to-slate-50 px-4">
        <img
            id="sidebarLogo"
            src="{{ asset('images/logo.png') }}"
            alt="Affiliate Program Logo"
            class="h-16 w-16 rounded-2xl object-cover">

        <button
            id="sidebarToggle"
            type="button"
            class="absolute right-3 top-1/2 flex h-8 w-8 -translate-y-1/2 items-center justify-center text-slate-700 transition hover:text-slate-900  "
            aria-label="Toggle sidebar">
            <i id="sidebarToggleIcon" class="fas fa-angle-left text-2xl transition-transform duration-300"></i>
        </button>
    </div>

    <nav id="sidebarMenu" class="min-h-0 flex-1 space-y-2 overflow-y-auto px-3 py-4">
        @if(isset($permissions['dashboard']) && in_array('read', $permissions['dashboard']))
            <a href="{{ route('dashboard') }}" class="{{ $navLinkBase }} sidebar-item">
                <span class="sidebar-icon flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100 text-slate-600 group-hover:bg-slate-200 group-hover:text-slate-900">
                    <i class="fas fa-tachometer-alt text-sm"></i>
                </span>
                <span class="sidebar-label">Dashboard</span>
            </a>
        @endif

        @php $managementPerms = $permissions['management'] ?? []; @endphp
        @if(count($managementPerms) > 0)
            <button
                class="{{ $navButtonBase }} sidebar-item"
                onclick="toggleDropdown('managementDropdown', 'dropdownArrow-management')">
                <span class="flex items-center gap-3">
                    <span class="sidebar-icon flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100 text-slate-600 group-hover:bg-slate-200 group-hover:text-slate-900">
                        <i class="fas fa-cogs text-sm"></i>
                    </span>
                    <span class="sidebar-label">NHI Access</span>
                </span>
                <i id="dropdownArrow-management" class="sidebar-chevron fas fa-chevron-down text-xs text-slate-400 transition-transform duration-200"></i>
            </button>

            <ul id="managementDropdown" class="sidebar-dropdown mt-1 ml-4 hidden space-y-1 border-l border-slate-200 pl-3">
                @if(in_array('read', $managementPerms))
                    <li>
                        <a href="{{ route('admin.index') }}" class="{{ $dropdownLinkBase }}">
                            <i class="fas fa-users w-4 text-slate-400"></i>
                            <span class="sidebar-label">Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('roles.index') }}" class="{{ $dropdownLinkBase }}">
                            <i class="fas fa-user-tag w-4 text-slate-400"></i>
                            <span class="sidebar-label">Roles</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('attendance.index') }}" class="{{ $dropdownLinkBase }}">
                            <i class="fas fa-calendar-check w-4 text-slate-400"></i>
                            <span class="sidebar-label">Attendance</span>
                        </a>
                    </li>
                @endif
            </ul>
        @endif

        @php $offersPerms = $permissions['offers'] ?? []; @endphp
        @if(count($offersPerms) > 0)
            <button
                class="{{ $navButtonBase }} sidebar-item"
                onclick="toggleDropdown('offersDropdown', 'dropdownArrow-offers')">
                <span class="flex items-center gap-3">
                    <span class="sidebar-icon flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100 text-slate-600 group-hover:bg-slate-200 group-hover:text-slate-900">
                        <i class="fas fa-briefcase text-sm"></i>
                    </span>
                    <span class="sidebar-label">Offers</span>
                </span>
                <i id="dropdownArrow-offers" class="sidebar-chevron fas fa-chevron-down text-xs text-slate-400 transition-transform duration-200"></i>
            </button>

            <ul id="offersDropdown" class="sidebar-dropdown mt-1 ml-4 hidden space-y-1 border-l border-slate-200 pl-3">
                @if(in_array('read', $offersPerms))
                    <li>
                        <a href="{{ route('offers.create') }}" class="{{ $dropdownLinkBase }}">
                            <i class="fas fa-plus w-4 text-slate-400"></i>
                            <span class="sidebar-label">Create Offer</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('offers.index') }}" class="{{ $dropdownLinkBase }}">
                            <i class="fas fa-eye w-4 text-slate-400"></i>
                            <span class="sidebar-label">Manage Offers</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('assigned_offers.index') }}" class="{{ $dropdownLinkBase }}">
                            <i class="fas fa-handshake w-4 text-slate-400"></i>
                            <span class="sidebar-label">Assigned Offers</span>
                        </a>
                    </li>
                @endif
            </ul>
        @endif

        @php $reportsPerms = $permissions['reports'] ?? []; @endphp
        @if(count($reportsPerms) > 0)
            <button
                class="{{ $navButtonBase }} sidebar-item"
                onclick="toggleDropdown('reportsDropdown', 'dropdownArrow-reports')">
                <span class="flex items-center gap-3">
                    <span class="sidebar-icon flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100 text-slate-600 group-hover:bg-slate-200 group-hover:text-slate-900">
                        <i class="fas fa-chart-line text-sm"></i>
                    </span>
                    <span class="sidebar-label">Reports</span>
                </span>
                <i id="dropdownArrow-reports" class="sidebar-chevron fas fa-chevron-down text-xs text-slate-400 transition-transform duration-200"></i>
            </button>

            <ul id="reportsDropdown" class="sidebar-dropdown mt-1 ml-4 hidden space-y-1 border-l border-slate-200 pl-3">
                @if(in_array('read', $reportsPerms))
                    <li>
                        <a href="{{ route('all.report') }}" class="{{ $dropdownLinkBase }}">
                            <i class="fas fa-file-alt w-4 text-slate-400"></i>
                            <span class="sidebar-label">General Reports</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('analytics.index') }}" class="{{ $dropdownLinkBase }}">
                            <i class="fas fa-chart-bar w-4 text-slate-400"></i>
                            <span class="sidebar-label">Analytics</span>
                        </a>
                    </li>
                @endif
            </ul>
        @endif

        @php $dataManagementPerms = $permissions['dataManagement'] ?? []; @endphp
        @if(count($dataManagementPerms) > 0)
            <button
                class="{{ $navButtonBase }} sidebar-item"
                onclick="toggleDropdown('dataManagementDropdown', 'dropdownArrow-dataManagement')">
                <span class="flex items-center gap-3">
                    <span class="sidebar-icon flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100 text-slate-600 group-hover:bg-slate-200 group-hover:text-slate-900">
                        <i class="fas fa-database text-sm"></i>
                    </span>
                    <span class="sidebar-label">Data Management</span>
                </span>
                <i id="dropdownArrow-dataManagement" class="sidebar-chevron fas fa-chevron-down text-xs text-slate-400 transition-transform duration-200"></i>
            </button>

            <ul id="dataManagementDropdown" class="sidebar-dropdown mt-1 ml-4 hidden space-y-1 border-l border-slate-200 pl-3">
                @if(in_array('read', $dataManagementPerms))
                    <li>
                        <a href="{{ route('cities.index') }}" class="{{ $dropdownLinkBase }}">
                            <i class="fas fa-city w-4 text-slate-400"></i>
                            <span class="sidebar-label">City</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('states.index') }}" class="{{ $dropdownLinkBase }}">
                            <i class="fas fa-map-marker-alt w-4 text-slate-400"></i>
                            <span class="sidebar-label">State</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('countries.index') }}" class="{{ $dropdownLinkBase }}">
                            <i class="fas fa-globe w-4 text-slate-400"></i>
                            <span class="sidebar-label">Country</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('languages.index') }}" class="{{ $dropdownLinkBase }}">
                            <i class="fas fa-language w-4 text-slate-400"></i>
                            <span class="sidebar-label">Language</span>
                        </a>
                    </li>
                @endif
            </ul>
        @endif

        @php $managersPerms = $permissions['managers'] ?? []; @endphp
        @if(count($managersPerms) > 0)
            <button
                class="{{ $navButtonBase }} sidebar-item"
                onclick="toggleDropdown('managersDropdown', 'dropdownArrow-managers')">
                <span class="flex items-center gap-3">
                    <span class="sidebar-icon flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100 text-slate-600 group-hover:bg-slate-200 group-hover:text-slate-900">
                        <i class="fas fa-users text-sm"></i>
                    </span>
                    <span class="sidebar-label">Managers</span>
                </span>
                <i id="dropdownArrow-managers" class="sidebar-chevron fas fa-chevron-down text-xs text-slate-400 transition-transform duration-200"></i>
            </button>

            <ul id="managersDropdown" class="sidebar-dropdown mt-1 ml-4 hidden space-y-1 border-l border-slate-200 pl-3">
                @if(in_array('read', $managersPerms))
                    <li>
                        <a href="{{ route('manager.index') }}" class="{{ $dropdownLinkBase }}">
                            <i class="fas fa-user w-4 text-slate-400"></i>
                            <span class="sidebar-label">Managers</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('manager.offers') }}" class="{{ $dropdownLinkBase }}">
                            <i class="fas fa-handshake w-4 text-slate-400"></i>
                            <span class="sidebar-label">My Assigned Offers</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('manager.report') }}" class="{{ $dropdownLinkBase }}">
                            <i class="fas fa-chart-bar w-4 text-slate-400"></i>
                            <span class="sidebar-label">Reports</span>
                        </a>
                    </li>
                @endif
            </ul>
        @endif

        @php $advertisersPerms = $permissions['advertisers'] ?? []; @endphp
        @if(count($advertisersPerms) > 0)
            <button
                class="{{ $navButtonBase }} sidebar-item"
                onclick="toggleDropdown('advertisersDropdown', 'dropdownArrow-advertisers')">
                <span class="flex items-center gap-3">
                    <span class="sidebar-icon flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100 text-slate-600 group-hover:bg-slate-200 group-hover:text-slate-900">
                        <i class="fas fa-bullhorn text-sm"></i>
                    </span>
                    <span class="sidebar-label">Advertisers</span>
                </span>
                <i id="dropdownArrow-advertisers" class="sidebar-chevron fas fa-chevron-down text-xs text-slate-400 transition-transform duration-200"></i>
            </button>

            <ul id="advertisersDropdown" class="sidebar-dropdown mt-1 ml-4 hidden space-y-1 border-l border-slate-200 pl-3">
                @if(in_array('read', $advertisersPerms))
                    <li>
                        <a href="{{ route('advertiser.index') }}" class="{{ $dropdownLinkBase }}">
                            <i class="fas fa-user w-4 text-slate-400"></i>
                            <span class="sidebar-label">Advertiser</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('advertiser.offers') }}" class="{{ $dropdownLinkBase }}">
                            <i class="fas fa-handshake w-4 text-slate-400"></i>
                            <span class="sidebar-label">My Assigned Offers</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('advertiser.report') }}" class="{{ $dropdownLinkBase }}">
                            <i class="fas fa-chart-bar w-4 text-slate-400"></i>
                            <span class="sidebar-label">Reports</span>
                        </a>
                    </li>
                @endif
            </ul>
        @endif

        @php $hrPerms = $permissions['hr'] ?? []; @endphp
        @if(count($hrPerms) > 0)
            <button
                class="{{ $navButtonBase }} sidebar-item"
                onclick="toggleDropdown('hrDropdown', 'dropdownArrow-hr')">
                <span class="flex items-center gap-3">
                    <span class="sidebar-icon flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100 text-slate-600 group-hover:bg-slate-200 group-hover:text-slate-900">
                        <i class="fas fa-user-friends text-sm"></i>
                    </span>
                    <span class="sidebar-label">HR</span>
                </span>
                <i id="dropdownArrow-hr" class="sidebar-chevron fas fa-chevron-down text-xs text-slate-400 transition-transform duration-200"></i>
            </button>

            <ul id="hrDropdown" class="sidebar-dropdown mt-1 ml-4 hidden space-y-1 border-l border-slate-200 pl-3">
                @if(in_array('read', $hrPerms))
                    <li>
                        <a href="{{ route('hr.index') }}" class="{{ $dropdownLinkBase }}">
                            <i class="fas fa-user w-4 text-slate-400"></i>
                            <span class="sidebar-label">HR</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('hr.offers') }}" class="{{ $dropdownLinkBase }}">
                            <i class="fas fa-handshake w-4 text-slate-400"></i>
                            <span class="sidebar-label">My Assigned Offers</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('hr.report') }}" class="{{ $dropdownLinkBase }}">
                            <i class="fas fa-chart-bar w-4 text-slate-400"></i>
                            <span class="sidebar-label">Reports</span>
                        </a>
                    </li>
                @endif
            </ul>
        @endif

        @php $employeePerms = $permissions['employee'] ?? []; @endphp
        @if(count($employeePerms) > 0)
            <button
                class="{{ $navButtonBase }} sidebar-item"
                onclick="toggleDropdown('employeeDropdown', 'dropdownArrow-employee')">
                <span class="flex items-center gap-3">
                    <span class="sidebar-icon flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100 text-slate-600 group-hover:bg-slate-200 group-hover:text-slate-900">
                        <i class="fas fa-user-tie text-sm"></i>
                    </span>
                    <span class="sidebar-label">Employee</span>
                </span>
                <i id="dropdownArrow-employee" class="sidebar-chevron fas fa-chevron-down text-xs text-slate-400 transition-transform duration-200"></i>
            </button>

            <ul id="employeeDropdown" class="sidebar-dropdown mt-1 ml-4 hidden space-y-1 border-l border-slate-200 pl-3">
                @if(in_array('read', $employeePerms))
                    <li>
                        <a href="{{ route('employees.index') }}" class="{{ $dropdownLinkBase }}">
                            <i class="fas fa-user w-4 text-slate-400"></i>
                            <span class="sidebar-label">Employee</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('employee.offers') }}" class="{{ $dropdownLinkBase }}">
                            <i class="fas fa-handshake w-4 text-slate-400"></i>
                            <span class="sidebar-label">My Assigned Offers</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('employee.report') }}" class="{{ $dropdownLinkBase }}">
                            <i class="fas fa-chart-bar w-4 text-slate-400"></i>
                            <span class="sidebar-label">Reports</span>
                        </a>
                    </li>
                @endif
            </ul>
        @endif

        @php $accountsPerms = $permissions['accounts'] ?? []; @endphp
        @if(count($accountsPerms) > 0)
            <button
                class="{{ $navButtonBase }} sidebar-item"
                onclick="toggleDropdown('accountsDropdown', 'dropdownArrow-accounts')">
                <span class="flex items-center gap-3">
                    <span class="sidebar-icon flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100 text-slate-600 group-hover:bg-slate-200 group-hover:text-slate-900">
                        <i class="fas fa-wallet text-sm"></i>
                    </span>
                    <span class="sidebar-label">Accounts</span>
                </span>
                <i id="dropdownArrow-accounts" class="sidebar-chevron fas fa-chevron-down text-xs text-slate-400 transition-transform duration-200"></i>
            </button>

            <ul id="accountsDropdown" class="sidebar-dropdown mt-1 ml-4 hidden space-y-1 border-l border-slate-200 pl-3">
                @if(in_array('read', $accountsPerms))
                    <li>
                        <a href="{{ route('accountant.index') }}" class="{{ $dropdownLinkBase }}">
                            <i class="fas fa-chart-pie w-4 text-slate-400"></i>
                            <span class="sidebar-label">Accountant</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('accountant.billing') }}" class="{{ $dropdownLinkBase }}">
                            <i class="fas fa-credit-card w-4 text-slate-400"></i>
                            <span class="sidebar-label">Billing Account</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="{{ $dropdownLinkBase }}">
                            <i class="fas fa-share w-4 text-slate-400"></i>
                            <span class="sidebar-label">Referrals</span>
                        </a>
                    </li>
                @endif
            </ul>
        @endif
    </nav>
</aside>
