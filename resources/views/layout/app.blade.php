<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affiliate Programme</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        ::-webkit-scrollbar {
            display: none;
        }
        #sidebarMenu {
            scrollbar-width: none; /* Firefox */
        }

        #sidebar[data-collapsed="true"] {
            width: 6rem;
        }

        #sidebar[data-collapsed="true"] #sidebarLogo {
            display: block;
            width: 2.5rem;
            height: 2.5rem;
        }

        #sidebar[data-collapsed="true"] .sidebar-brand {
            justify-content: space-between;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }

        #sidebar[data-collapsed="true"] .sidebar-label,
        #sidebar[data-collapsed="true"] .sidebar-chevron,
        #sidebar[data-collapsed="true"] .sidebar-dropdown {
            display: none !important;
        }

        #sidebar[data-collapsed="true"] .sidebar-item {
            justify-content: center;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }

        #sidebar[data-collapsed="true"] .sidebar-item > span:first-child {
            gap: 0;
        }

        #sidebar[data-collapsed="true"] .sidebar-icon {
            margin-right: 0;
        }

        body[data-sidebar-collapsed="true"] #sidebar {
            width: 6rem !important;
        }

        body[data-sidebar-collapsed="true"] #header {
            left: 6rem !important;
        }

        body[data-sidebar-collapsed="true"] #mainContent {
            margin-left: 6rem !important;
        }

        body:not([data-sidebar-collapsed="true"]) #sidebar {
            width: 16rem;
        }

        body:not([data-sidebar-collapsed="true"]) #header {
            left: 16rem;
        }

        body:not([data-sidebar-collapsed="true"]) #mainContent {
            margin-left: 16rem;
        }
    </style>

</head>

<body class="bg-slate-50 text-slate-900">

    <!-- Sidebar -->
    @include('layout.sidebar')

    <!-- Header -->
    @include('layout.header')

   
    <!-- Main Content -->
    <main class="ml-0 md:ml-64 mt-24 p-4 md:p-6 overflow-y-auto min-h-screen transition-all duration-300" id="mainContent">
        @yield('content')
    </main>

    <!-- JS for Dropdown and Sidebar Toggle -->
    <script>
        function toggleDropdown(id, arrowId) {
            const dropdown = document.getElementById(id);
            dropdown.classList.toggle('hidden');

            if (arrowId) {
                const arrow = document.getElementById(arrowId);
                arrow.classList.toggle('rotate-180');
            }
        }

        // Sidebar toggle functionality
        let isCollapsed = false;
        let isMobile = window.innerWidth < 768; // md breakpoint
        const sidebar = document.getElementById('sidebar');
        const header = document.getElementById('header');
        const hrLine = document.getElementById('hrLine');
        const mainContent = document.getElementById('mainContent');
        const desktopToggleBtn = document.getElementById('sidebarToggle');
        const desktopToggleIcon = document.getElementById('sidebarToggleIcon');
        const mobileToggleBtn = document.getElementById('sidebarMobileToggle');
        const fullscreenToggleBtn = document.getElementById('fullscreenToggle');
        const fullscreenToggleIcon = document.getElementById('fullscreenToggleIcon');
        const indiaTimeDisplay = document.getElementById('indiaTimeDisplay');
        const fullscreenPreferenceKey = 'affiliate_programme_fullscreen_enabled';

        function setSidebarToggleIcon() {
            if (!desktopToggleIcon) return;
            desktopToggleIcon.classList.toggle('fa-angle-left', !isCollapsed);
            desktopToggleIcon.classList.toggle('fa-angle-right', isCollapsed);
            if (sidebar) {
                sidebar.dataset.collapsed = isCollapsed ? 'true' : 'false';
            }
            document.body.dataset.sidebarCollapsed = isCollapsed ? 'true' : 'false';
        }

        function setFullscreenIcon() {
            if (!fullscreenToggleIcon) return;
            const isFullscreen = !!document.fullscreenElement;
            fullscreenToggleIcon.classList.toggle('fa-expand', !isFullscreen);
            fullscreenToggleIcon.classList.toggle('fa-compress', isFullscreen);
        }

        function setFullscreenPreference(enabled) {
            try {
                localStorage.setItem(fullscreenPreferenceKey, enabled ? '1' : '0');
            } catch (error) {
                console.error('Could not save fullscreen preference:', error);
            }
        }

        function shouldKeepFullscreen() {
            try {
                return localStorage.getItem(fullscreenPreferenceKey) === '1';
            } catch (error) {
                return false;
            }
        }

        async function restoreFullscreenPreference() {
            if (!shouldKeepFullscreen() || document.fullscreenElement) {
                return;
            }

            try {
                await document.documentElement.requestFullscreen();
            } catch (error) {
                console.warn('Fullscreen restore blocked by the browser:', error);
            }
        }

        async function toggleFullscreen() {
            try {
                if (!document.fullscreenElement) {
                    await document.documentElement.requestFullscreen();
                    setFullscreenPreference(true);
                } else {
                    await document.exitFullscreen();
                    setFullscreenPreference(false);
                }
            } catch (error) {
                console.error('Fullscreen toggle failed:', error);
            }
        }

        function updateIndiaTime() {
            if (!indiaTimeDisplay) return;

            const formatter = new Intl.DateTimeFormat('en-IN', {
                timeZone: 'Asia/Kolkata',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true,
                weekday: 'short',
                day: '2-digit',
                month: 'short',
                year: 'numeric',
            });

            indiaTimeDisplay.textContent = formatter.format(new Date()).replace(/\b(am|pm)\b/i, match => match.toUpperCase());
        }

        function updateLayout() {
            isMobile = window.innerWidth < 768;
            if (isMobile) {
                if (sidebar) sidebar.classList.add('hidden');
                if (header) {
                    header.classList.remove('left-64');
                    header.classList.add('left-0');
                }
                if (hrLine) {
                    hrLine.classList.remove('left-64');
                    hrLine.classList.add('left-0');
                }
                if (mainContent) {
                    mainContent.classList.remove('ml-64');
                    mainContent.classList.add('ml-0');
                }
            } else {
                if (sidebar) sidebar.classList.remove('hidden');
                if (header) {
                    header.classList.remove('left-0');
                    header.classList.add('left-64');
                }
                if (hrLine) {
                    hrLine.classList.remove('left-0');
                    hrLine.classList.add('left-64');
                }
                if (mainContent) {
                    mainContent.classList.remove('ml-0');
                    mainContent.classList.add('ml-64');
                }

                if (sidebar) {
                    sidebar.classList.remove('w-16', 'w-24', 'w-64');
                    sidebar.classList.add(isCollapsed ? 'w-24' : 'w-64');
                }

                setSidebarToggleIcon();
            }
        }

        window.addEventListener('resize', updateLayout);
        updateLayout(); // Initial call
        setSidebarToggleIcon();
        setFullscreenIcon();
        updateIndiaTime();
        restoreFullscreenPreference();

        setInterval(updateIndiaTime, 1000);

        window.addEventListener('pageshow', restoreFullscreenPreference);

        if (desktopToggleBtn) {
            desktopToggleBtn.addEventListener('click', function() {
                if (isMobile) return;

                isCollapsed = !isCollapsed;

                if (isCollapsed) {
                    sidebar.classList.remove('w-64');
                    sidebar.classList.add('w-24');
                    if (header) {
                        header.classList.remove('left-64');
                        header.classList.add('left-24');
                    }
                    if (hrLine) {
                        hrLine.classList.remove('left-64');
                        hrLine.classList.add('left-24');
                    }
                    if (mainContent) {
                        mainContent.classList.remove('ml-64');
                        mainContent.classList.add('ml-24');
                    }
                    // Hide only the text labels, keep icons visible
                    document.querySelectorAll('#sidebar .sidebar-label').forEach(label => {
                        label.classList.add('hidden');
                    });
                } else {
                    sidebar.classList.remove('w-24');
                    sidebar.classList.add('w-64');
                    if (header) {
                        header.classList.remove('left-24');
                        header.classList.add('left-64');
                    }
                    if (hrLine) {
                        hrLine.classList.remove('left-24');
                        hrLine.classList.add('left-64');
                    }
                    if (mainContent) {
                        mainContent.classList.remove('ml-24');
                        mainContent.classList.add('ml-64');
                    }
                    // Show the labels again
                    document.querySelectorAll('#sidebar .sidebar-label.hidden').forEach(label => {
                        label.classList.remove('hidden');
                    });
                }

                setSidebarToggleIcon();
            });
        }

        if (mobileToggleBtn) {
            mobileToggleBtn.addEventListener('click', function() {
                if (!isMobile) return;
                sidebar.classList.remove('w-24');
                sidebar.classList.add('w-64');
                sidebar.classList.toggle('hidden');
            });
        }

        if (fullscreenToggleBtn) {
            fullscreenToggleBtn.addEventListener('click', toggleFullscreen);
            document.addEventListener('fullscreenchange', function() {
                setFullscreenIcon();

                if (!document.fullscreenElement && shouldKeepFullscreen()) {
                    setFullscreenPreference(false);
                }
            });
        }

        // User dropdown toggle functionality
        const userDropdownToggle = document.getElementById('userDropdownToggle');
        const userDropdown = document.getElementById('userDropdown');

        if (userDropdownToggle && userDropdown) {
            userDropdownToggle.addEventListener('click', function(event) {
                event.stopPropagation();
                userDropdown.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!userDropdownToggle.contains(event.target) && !userDropdown.contains(event.target)) {
                    userDropdown.classList.add('hidden');
                }
            });
        }
    </script>

    <!-- Footer -->
    @include('layout.footer')

    {{-- Page specific scripts --}}
    @yield('scripts')

</body>

</html>
