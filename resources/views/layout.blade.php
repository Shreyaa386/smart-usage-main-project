<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>smart-usage</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CDN config -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        darkMode: 'class',
        theme: {
          extend: {
            fontFamily: {
              sans: ['Inter', 'ui-sans-serif', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', 'sans-serif'],
            },
            colors: {
              border: "hsl(var(--border))",
              input: "hsl(var(--input))",
              ring: "hsl(var(--ring))",
              background: "hsl(var(--background))",
              foreground: "hsl(var(--foreground))",
              card: {
                DEFAULT: "hsl(var(--card))",
                foreground: "hsl(var(--card-foreground))",
              },
              primary: {
                DEFAULT: "hsl(var(--primary))",
                foreground: "hsl(var(--primary-foreground))",
              },
              secondary: {
                DEFAULT: "hsl(var(--secondary))",
                foreground: "hsl(var(--secondary-foreground))",
              },
              muted: {
                DEFAULT: "hsl(var(--muted))",
                foreground: "hsl(var(--muted-foreground))",
              },
              accent: {
                DEFAULT: "hsl(var(--accent))",
                foreground: "hsl(var(--accent-foreground))",
              },
              destructive: {
                DEFAULT: "hsl(var(--destructive))",
                foreground: "hsl(var(--destructive-foreground))",
              },
              water: "hsl(var(--water))",
              electricity: "hsl(var(--electricity))"
            },
            borderRadius: {
                lg: "var(--radius)",
                md: "calc(var(--radius) - 2px)",
                sm: "calc(var(--radius) - 4px)",
            }
          }
        }
      }
    </script>
    <style type="text/tailwindcss">
      @layer base {
        :root {
          --background: 0 0% 100%;
          --foreground: 224 71.4% 4.1%;
          --card: 0 0% 100%;
          --card-foreground: 224 71.4% 4.1%;
          --popover: 0 0% 100%;
          --popover-foreground: 224 71.4% 4.1%;
          --primary: 221.2 83.2% 53.3%;
          --primary-foreground: 210 40% 98%;
          --secondary: 210 40% 96.1%;
          --secondary-foreground: 222.2 47.4% 11.2%;
          --muted: 220 14.3% 95.9%;
          --muted-foreground: 220 8.9% 46.1%;
          --accent: 220 14.3% 95.9%;
          --accent-foreground: 220.9 39.3% 11%;
          --destructive: 0 84.2% 60.2%;
          --destructive-foreground: 210 20% 98%;
          --border: 214.3 31.8% 91.4%;
          --input: 214.3 31.8% 91.4%;
          --ring: 221.2 83.2% 53.3%;
          --radius: 0.75rem;
          --water: 217 91% 60%;
          --electricity: 142 71% 45%;
        }
        .dark {
          --background: 224 71.4% 4.1%;
          --foreground: 210 20% 98%;
          --card: 224 71.4% 4.1%;
          --card-foreground: 210 20% 98%;
          --popover: 224 71.4% 4.1%;
          --popover-foreground: 210 20% 98%;
          --primary: 217.2 91.2% 59.8%;
          --primary-foreground: 222.2 47.4% 11.2%;
          --secondary: 217.2 32.6% 17.5%;
          --secondary-foreground: 210 40% 98%;
          --muted: 217.2 32.6% 17.5%;
          --muted-foreground: 215 20.2% 65.1%;
          --accent: 217.2 32.6% 17.5%;
          --accent-foreground: 210 40% 98%;
          --destructive: 0 62.8% 30.6%;
          --destructive-foreground: 210 40% 98%;
          --border: 217.2 32.6% 17.5%;
          --input: 217.2 32.6% 17.5%;
          --ring: 224.3 76.3% 48%;
        }
      }
      @layer base {
        * {
          @apply border-border;
        }
        body {
          @apply bg-background text-foreground;
        }
      }
      .glass {
        @apply bg-background/60 backdrop-blur-md border border-border/50;
      }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
      function toggleDarkMode() {
        document.documentElement.classList.toggle('dark');
        localStorage.theme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
      }
      if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark')
      } else {
        document.documentElement.classList.remove('dark')
      }
    </script>
</head>
<body class="flex min-h-screen min-h-[100dvh] h-screen overflow-hidden antialiased font-sans bg-background text-sm sm:text-base selection:bg-primary/10 selection:text-primary">
    
    <!-- Mobile / tablet sidebar overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden transition-opacity" onclick="toggleSidebar()"></div>

    <!-- Sidebar: drawer on phone & tablet, fixed on desktop -->
    <aside id="sidebar" class="fixed lg:relative w-[min(280px,85vw)] sm:w-64 bg-card border-r border-border shadow-sm flex flex-col transition-transform duration-300 z-50 h-full -translate-x-full lg:translate-x-0">
        <div class="h-14 sm:h-16 flex items-center justify-between px-4 sm:px-6 border-b border-border">
            <div class="flex items-center space-x-3 group cursor-pointer">
                <div class="w-8 h-8 bg-primary flex items-center justify-center rounded-lg rotate-3 group-hover:rotate-0 transition-transform duration-300">
                    <i class="fa-solid fa-leaf text-primary-foreground text-sm"></i>
                </div>
                <span class="text-xl font-bold tracking-tight text-foreground">smart-usage</span>
            </div>
            <!-- Close button for mobile -->
            <button onclick="toggleSidebar()" class="lg:hidden text-muted-foreground hover:text-foreground p-1 rounded-lg hover:bg-accent transition-all" aria-label="Close menu">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>
        
        <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
            <div class="px-3 mb-4">
                <p class="text-[10px] font-bold text-muted-foreground uppercase tracking-widest">Main Menu</p>
            </div>
            
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'bg-primary text-primary-foreground shadow-md shadow-primary/20 font-semibold' : 'text-muted-foreground hover:bg-accent hover:text-accent-foreground' }}">
                <i class="fa-solid fa-chart-line w-5 group-hover:scale-110 transition-transform"></i> 
                <span class="text-sm">Dashboard</span>
            </a>
            
            <a href="{{ route('add-usage') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('add-usage') ? 'bg-primary text-primary-foreground shadow-md shadow-primary/20 font-semibold' : 'text-muted-foreground hover:bg-accent hover:text-accent-foreground' }}">
                <i class="fa-solid fa-plus w-5 group-hover:scale-110 transition-transform"></i> 
                <span class="text-sm">Add Usage</span>
            </a>
            
            <a href="{{ route('history') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('history') ? 'bg-primary text-primary-foreground shadow-md shadow-primary/20 font-semibold' : 'text-muted-foreground hover:bg-accent hover:text-accent-foreground' }}">
                <i class="fa-solid fa-table-list w-5 group-hover:scale-110 transition-transform"></i> 
                <span class="text-sm">History</span>
            </a>
            
            <a href="{{ route('analytics') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('analytics') ? 'bg-primary text-primary-foreground shadow-md shadow-primary/20 font-semibold' : 'text-muted-foreground hover:bg-accent hover:text-accent-foreground' }}">
                <i class="fa-solid fa-chart-pie w-5 group-hover:scale-110 transition-transform"></i> 
                <span class="text-sm">Analytics</span>
            </a>
            
            <a href="{{ route('alerts') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('alerts') ? 'bg-primary text-primary-foreground shadow-md shadow-primary/20 font-semibold' : 'text-muted-foreground hover:bg-accent hover:text-accent-foreground' }}">
                <i class="fa-solid fa-bell w-5 group-hover:scale-110 transition-transform"></i> 
                <span class="text-sm">Alerts</span>
            </a>

            @if(Auth::check() && Auth::user()->email === 'admin@gmail.com')
            <div class="pt-6 px-3 mb-2">
                <p class="text-[10px] font-bold text-primary uppercase tracking-widest">System Admin</p>
            </div>
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition-all duration-200 group text-muted-foreground hover:bg-primary/5 hover:text-primary border border-transparent hover:border-primary/20">
                <i class="fa-solid fa-users-gear w-5 group-hover:scale-110 transition-transform"></i> 
                <span class="text-sm font-bold">User Management</span>
            </a>
            <a href="{{ route('history') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition-all duration-200 group text-muted-foreground hover:bg-primary/5 hover:text-primary border border-transparent hover:border-primary/20">
                <i class="fa-solid fa-database w-5 group-hover:scale-110 transition-transform"></i> 
                <span class="text-sm font-bold">Global Logs</span>
            </a>
            @endif
        </nav>

        <div class="p-4 border-t border-border">
            <div class="bg-muted/50 rounded-2xl p-4 mb-4 hidden lg:block">
                <p class="text-xs font-semibold text-foreground/80 mb-1">Eco Tip</p>
                <p class="text-[10px] text-muted-foreground leading-relaxed">Lowering your thermostat by 1°C can save up to 10% on your energy bill.</p>
            </div>
            
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center space-x-2 p-2.5 text-sm font-bold text-destructive hover:bg-destructive/10 rounded-xl transition-all active:scale-[0.98]">
                    <i class="fa-solid fa-sign-out-alt"></i> <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden relative w-full">
        <!-- Background Decoration -->
        <div class="absolute top-0 right-0 w-[300px] md:w-[500px] h-[300px] md:h-[500px] bg-primary/5 rounded-full blur-[120px] -z-10 -mr-32 md:-mr-64 -mt-32 md:-mt-64"></div>
        <div class="absolute bottom-0 left-0 w-[200px] md:w-[400px] h-[200px] md:h-[400px] bg-secondary/5 rounded-full blur-[100px] -z-10 -ml-24 md:-ml-48 -mb-24 md:-mb-48"></div>

        <!-- Top Navbar -->
        <header class="h-14 md:h-16 bg-card/95 backdrop-blur-md flex items-center justify-between px-4 md:px-8 border-b border-border z-20 sticky top-0 transition-colors shadow-sm">
            <div class="flex items-center space-x-3 md:space-x-4">
                <!-- Hamburger Menu Button (Mobile Only) -->
                <button onclick="toggleSidebar()" class="lg:hidden text-muted-foreground hover:text-foreground p-2 rounded-xl hover:bg-accent transition-all focus:outline-none active:scale-95" aria-label="Open menu">
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>
                <h2 class="text-sm sm:text-base md:text-lg font-bold tracking-tight text-foreground truncate max-w-[50vw] sm:max-w-none">@yield('header')</h2>
            </div>
            
            <div class="flex items-center space-x-3 md:space-x-6">
                <button onclick="toggleDarkMode()" class="text-muted-foreground hover:text-foreground p-2 md:p-2.5 rounded-xl hover:bg-accent transition-all focus:outline-none active:scale-95">
                    <i class="fa-solid fa-cloud-moon text-base md:text-lg"></i>
                </button>
                
                <div class="h-8 w-px bg-border/60 mx-1 md:mx-2 hidden sm:block"></div>
                
                <a href="{{ route('profile') }}" class="flex items-center space-x-2 md:space-x-3 group transition-all">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs md:text-sm font-bold text-foreground leading-none mb-1 group-hover:text-primary transition-colors">{{ Auth::check() ? Auth::user()->name : 'Guest' }}</p>
                        <p class="text-[9px] md:text-[10px] font-medium text-muted-foreground uppercase tracking-wider">Premium User</p>
                    </div>
                    <div class="h-9 w-9 md:h-10 md:w-10 bg-primary/10 rounded-xl flex items-center justify-center border border-primary/20 group-hover:border-primary group-hover:bg-primary transition-all duration-300">
                        <i class="fa-solid fa-user text-primary group-hover:text-primary-foreground text-sm md:text-base"></i>
                    </div>
                </a>
            </div>
        </header>

        <!-- Content Body -->
        <div class="relative z-10 flex-1 overflow-auto p-4 md:p-6 transition-colors">
            @if(session('success'))
                <div class="p-3 md:p-4 mb-4 text-xs md:text-sm text-green-800 rounded-md bg-green-50 dark:bg-green-900/20 dark:text-green-400 border border-green-200 dark:border-green-800" role="alert">
                  {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="p-3 md:p-4 mb-4 text-xs md:text-sm text-red-800 rounded-md bg-red-50 dark:bg-red-900/20 dark:text-red-400 border border-red-200 dark:border-red-800" role="alert">
                  {{ session('error') }}
                </div>
            @endif
            @yield('content')
        </div>
    </main>
    
    <!-- Sidebar Toggle Script -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
            
            // Prevent body scroll when sidebar is open on mobile
            if (!sidebar.classList.contains('-translate-x-full')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        }

        // Close sidebar on window resize to desktop (lg breakpoint)
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                overlay.classList.add('hidden');
                document.body.style.overflow = '';
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
