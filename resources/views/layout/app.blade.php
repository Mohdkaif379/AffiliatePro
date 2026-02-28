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
        /* Hide scrollbar for sidebar */
        #sidebar::-webkit-scrollbar {
            display: none;
        }
        #sidebar {
            scrollbar-width: none; /* Firefox */
        }
    </style>

</head>

<body class="bg-gray-900">

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
        const logoText = document.getElementById('logoText');
        const toggleBtn = document.getElementById('sidebarToggle');

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
            }
        }

        window.addEventListener('resize', updateLayout);
        updateLayout(); // Initial call

        toggleBtn.addEventListener('click', function() {
            if (isMobile) {
                sidebar.classList.toggle('hidden');
            } else {
                isCollapsed = !isCollapsed;

                if (isCollapsed) {
                    sidebar.classList.remove('w-64');
                    sidebar.classList.add('w-16');
                    header.classList.remove('left-64');
                    header.classList.add('left-16');
                    hrLine.classList.remove('left-64');
                    hrLine.classList.add('left-16');
                    mainContent.classList.remove('ml-64');
                    mainContent.classList.add('ml-16');
                    logoText.classList.add('hidden');
                    // Hide text in menu items
                    document.querySelectorAll('#sidebar nav a span:not(.hidden), #sidebar nav button span:not(.hidden)').forEach(span => {
                        span.classList.add('hidden');
                    });
                } else {
                    sidebar.classList.remove('w-16');
                    sidebar.classList.add('w-64');
                    header.classList.remove('left-16');
                    header.classList.add('left-64');
                    hrLine.classList.remove('left-16');
                    hrLine.classList.add('left-64');
                    mainContent.classList.remove('ml-16');
                    mainContent.classList.add('ml-64');
                    logoText.classList.remove('hidden');
                    // Show text in menu items
                    document.querySelectorAll('#sidebar nav a span.hidden, #sidebar nav button span.hidden').forEach(span => {
                        span.classList.remove('hidden');
                    });
                }
            }
        });

        // User dropdown toggle functionality
        const userDropdownToggle = document.getElementById('userDropdownToggle');
        const userDropdown = document.getElementById('userDropdown');

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
    </script>

    <!-- Footer -->
    @include('layout.footer')

    {{-- Page specific scripts --}}
    @yield('scripts')

</body>

</html>
