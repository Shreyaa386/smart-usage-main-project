<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <script>
      // Load and apply Appearance settings IMMEDIATELY before page paint to avoid styling flashes
      (function() {
        const themeColor = localStorage.getItem('su-accent-color') || 'blue';
        const fontSize = localStorage.getItem('su-font-size') || '16';
        const layoutMode = localStorage.getItem('su-layout-mode') || 'fullscreen';
        
        // Define theme HSL configurations
        const colors = {
          green: { light: '142.5 76.2% 36.3%', dark: '142.5 70.6% 45.3%' },
          blue: { light: '221.2 83.2% 53.3%', dark: '217.2 91.2% 59.8%' },
          amber: { light: '37.7 92.1% 50.2%', dark: '37.7 90.1% 55.2%' },
          orange: { light: '24.6 95% 53.1%', dark: '24.6 90% 58.1%' },
          purple: { light: '271.5 81.3% 55.9%', dark: '271.5 85% 65%' },
          rose: { light: '346.8 77.2% 49.8%', dark: '346.8 80% 55.8%' }
        };
        
        const selected = colors[themeColor] || colors.blue;
        
        const style = document.createElement('style');
        style.id = 'su-dynamic-variables';
        style.innerHTML = `
          :root {
            --primary: ${selected.light} !important;
            --ring: ${selected.light} !important;
          }
          .dark {
            --primary: ${selected.dark} !important;
            --ring: ${selected.dark} !important;
          }
          html {
            font-size: calc(${fontSize}px - 2px) !important;
          }
          @media (min-width: 640px) {
            html {
              font-size: calc(${fontSize}px - 1px) !important;
            }
          }
          @media (min-width: 1024px) {
            html {
              font-size: ${fontSize}px !important;
            }
          }
        `;
        document.head.appendChild(style);
        
        window.addEventListener('DOMContentLoaded', () => {
          if (layoutMode === 'floating') {
            document.body.classList.add('layout-floating');
          }
        });
      })();
    </script>
    <script>
      // One-time migration: upgrade old 'image' default to 'video' for presentation
      // This only runs once — sets su-bg-type to 'video' if never set before
      (function() {
        const savedType = localStorage.getItem('su-bg-type');
        const migrated  = localStorage.getItem('su-bg-migrated-v2');
        if (!migrated) {
          // First time after update — force video mode regardless of old setting
          localStorage.setItem('su-bg-type', 'video');
          localStorage.setItem('su-bg-migrated-v2', '1');
        }
      })();
    </script>
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
        html {
          /* Transparent so the fixed video background shows through */
          background: transparent !important;
        }
        body {
          @apply bg-background/0 text-foreground;
          background-color: transparent !important;
        }
      }
      .glass {
        background-color: hsl(var(--background) / var(--card-opacity, 0.6)) !important;
        backdrop-filter: blur(var(--card-blur, 12px)) saturate(120%) !important;
        -webkit-backdrop-filter: blur(var(--card-blur, 12px)) saturate(120%) !important;
        border: 1px solid hsl(var(--border) / calc(var(--card-opacity, 0.6) + 0.1)) !important;
      }
      .bg-card {
        background-color: hsl(var(--card) / var(--card-opacity, 0.95)) !important;
        backdrop-filter: blur(var(--card-blur, 0px)) saturate(120%);
        -webkit-backdrop-filter: blur(var(--card-blur, 0px)) saturate(120%);
        border-color: hsl(var(--border) / calc(var(--card-opacity, 0.95) + 0.05)) !important;
        transition: background-color 0.3s ease, border-color 0.3s ease, backdrop-filter 0.3s ease;
      }
      aside#sidebar {
        background-color: hsl(var(--card) / calc(var(--card-opacity, 0.95) * 1.05)) !important;
        backdrop-filter: blur(var(--card-blur, 0px));
        -webkit-backdrop-filter: blur(var(--card-blur, 0px));
        border-color: hsl(var(--border) / calc(var(--card-opacity, 0.95) + 0.05)) !important;
        transition: background-color 0.3s ease, border-color 0.3s ease;
      }
      header {
        background-color: hsl(var(--card) / calc(var(--card-opacity, 0.95) * 1.02)) !important;
        backdrop-filter: blur(var(--card-blur, 0px));
        -webkit-backdrop-filter: blur(var(--card-blur, 0px));
        border-color: hsl(var(--border) / calc(var(--card-opacity, 0.95) + 0.05)) !important;
        transition: background-color 0.3s ease, border-color 0.3s ease;
      }
      
      /* Layout Floating Deck Classes */
      body.layout-floating {
        padding: 1.25rem !important;
        background: transparent !important;
        gap: 1.25rem !important;
      }
      body.layout-floating #sidebar {
        border-radius: 1.25rem !important;
        height: calc(100vh - 2.5rem) !important;
        border: 1px solid hsl(var(--border) / 0.4) !important;
        box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.05), 0 4px 6px -4px rgb(0 0 0 / 0.05) !important;
      }
      body.layout-floating main {
        border-radius: 1.25rem !important;
        height: calc(100vh - 2.5rem) !important;
        border: 1px solid hsl(var(--border) / 0.4) !important;
        box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1) !important;
      }
      
      /* Custom Spin animation */
      .animate-spin-slow {
        animation: spin 8s linear infinite;
      }
      @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
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
<link rel="stylesheet" href="{{ asset('css/background-video.css') }}">
</head>
<body class="flex min-h-screen min-h-[100dvh] h-screen overflow-hidden antialiased font-sans bg-transparent text-sm sm:text-base selection:bg-primary/10 selection:text-primary">
    <!-- Full-screen background video -->
    <video id="bg-video" autoplay loop muted playsinline class="fixed inset-0 w-full h-full object-cover -z-20" style="background-color: #000;">
        <source src="{{ asset('videos/login.mp4') }}" type="video/mp4">
        <!-- Fallback image -->
        <img src="{{ asset('images/fallback.jpg') }}" alt="Background" class="w-full h-full object-cover" />
    </video>
    <!-- Dark overlay for readability -->
    
    
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
            
            <a href="{{ route('tips') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('tips') ? 'bg-primary text-primary-foreground shadow-md shadow-primary/20 font-semibold' : 'text-muted-foreground hover:bg-accent hover:text-accent-foreground' }}">
                <i class="fa-solid fa-lightbulb w-5 group-hover:scale-110 transition-transform"></i> 
                <span class="text-sm">Tips</span>
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
        <div class="relative flex-1 overflow-auto p-4 md:p-6 transition-colors">
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

    <!-- Floating Appearance Settings Trigger -->
    <button onclick="toggleCustomizer()" class="fixed bottom-6 right-6 z-50 w-12 h-12 bg-primary text-primary-foreground rounded-full flex items-center justify-center shadow-lg shadow-primary/30 hover:scale-110 active:scale-95 transition-all duration-200 border border-primary/20 cursor-pointer" aria-label="Open UI Customizer">
        <i class="fa-solid fa-paintbrush text-lg animate-spin-slow"></i>
    </button>

    <!-- UI Customizer Drawer -->
    <div id="customizer-drawer" class="fixed inset-y-0 right-0 w-80 sm:w-96 bg-card/95 backdrop-blur-xl border-l border-border shadow-2xl z-50 translate-x-full transition-transform duration-300 flex flex-col">
        <!-- Header -->
        <div class="h-14 sm:h-16 flex items-center justify-between px-6 border-b border-border">
            <div class="flex items-center space-x-2">
                <i class="fa-solid fa-wand-magic-sparkles text-primary"></i>
                <span class="text-sm sm:text-base font-bold text-foreground">Customize UI</span>
            </div>
            <button onclick="toggleCustomizer()" class="text-muted-foreground hover:text-foreground p-1 rounded-lg hover:bg-accent transition-all cursor-pointer">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>
        
        <!-- Body (Scrollable) -->
        <div class="flex-1 overflow-y-auto p-6 space-y-6">
            <!-- Accent Color Selection -->
            <div class="space-y-3">
                <label class="text-[10px] font-bold text-muted-foreground uppercase tracking-wider">Accent Theme Color</label>
                <div class="grid grid-cols-3 gap-2">
                    <button onclick="setAccentColor('green')" class="flex flex-col items-center justify-center p-2.5 rounded-xl border border-border hover:bg-accent/50 transition-all cursor-pointer">
                        <div class="w-5 h-5 rounded-full bg-emerald-500 mb-1"></div>
                        <span class="text-[9px] font-bold">Eco Green</span>
                    </button>
                    <button onclick="setAccentColor('blue')" class="flex flex-col items-center justify-center p-2.5 rounded-xl border border-border hover:bg-accent/50 transition-all cursor-pointer">
                        <div class="w-5 h-5 rounded-full bg-blue-500 mb-1"></div>
                        <span class="text-[9px] font-bold">Water Blue</span>
                    </button>
                    <button onclick="setAccentColor('amber')" class="flex flex-col items-center justify-center p-2.5 rounded-xl border border-border hover:bg-accent/50 transition-all cursor-pointer">
                        <div class="w-5 h-5 rounded-full bg-amber-500 mb-1"></div>
                        <span class="text-[9px] font-bold">Power Gold</span>
                    </button>
                    <button onclick="setAccentColor('orange')" class="flex flex-col items-center justify-center p-2.5 rounded-xl border border-border hover:bg-accent/50 transition-all cursor-pointer">
                        <div class="w-5 h-5 rounded-full bg-orange-500 mb-1"></div>
                        <span class="text-[9px] font-bold">Solar Coral</span>
                    </button>
                    <button onclick="setAccentColor('purple')" class="flex flex-col items-center justify-center p-2.5 rounded-xl border border-border hover:bg-accent/50 transition-all cursor-pointer">
                        <div class="w-5 h-5 rounded-full bg-purple-500 mb-1"></div>
                        <span class="text-[9px] font-bold">Future Neon</span>
                    </button>
                    <button onclick="setAccentColor('rose')" class="flex flex-col items-center justify-center p-2.5 rounded-xl border border-border hover:bg-accent/50 transition-all cursor-pointer">
                        <div class="w-5 h-5 rounded-full bg-rose-500 mb-1"></div>
                        <span class="text-[9px] font-bold">Warm Rose</span>
                    </button>
                </div>
            </div>
            
            <hr class="border-border/60">

            <!-- Font Size Adjustment -->
            <div class="space-y-3">
                <label class="text-[10px] font-bold text-muted-foreground uppercase tracking-wider">Font Size Scale</label>
                <div class="flex items-center space-x-4">
                    <span class="text-xs font-semibold text-muted-foreground">A-</span>
                    <input type="range" id="font-size-slider" min="13" max="19" step="1" class="flex-1 accent-primary cursor-pointer animate-none" oninput="setFontSize(this.value)">
                    <span class="text-sm font-semibold text-foreground">A+</span>
                </div>
                <div class="flex justify-between text-[9px] text-muted-foreground font-semibold px-1">
                    <span>Small</span>
                    <span>Normal</span>
                    <span>Large</span>
                    <span>X-Large</span>
                </div>
            </div>

            <hr class="border-border/60">

            <!-- Layout Mode -->
            <div class="space-y-3">
                <label class="text-[10px] font-bold text-muted-foreground uppercase tracking-wider">Interface Layout</label>
                <div class="grid grid-cols-2 gap-2">
                    <button id="layout-full-btn" onclick="setLayoutMode('fullscreen')" class="flex flex-col items-center justify-center p-3 rounded-xl border hover:bg-accent/50 transition-all cursor-pointer">
                        <i class="fa-solid fa-maximize text-base text-muted-foreground mb-1.5"></i>
                        <span class="text-xs font-bold">Full Screen</span>
                    </button>
                    <button id="layout-float-btn" onclick="setLayoutMode('floating')" class="flex flex-col items-center justify-center p-3 rounded-xl border hover:bg-accent/50 transition-all cursor-pointer">
                        <i class="fa-solid fa-pager text-base text-muted-foreground mb-1.5"></i>
                        <span class="text-xs font-bold">Floating Deck</span>
                    </button>
                </div>
            </div>

            <hr class="border-border/60">

            <!-- Background Type -->
            <div class="space-y-3">
                <label class="text-[10px] font-bold text-muted-foreground uppercase tracking-wider">Background Mode</label>
                <div class="grid grid-cols-3 gap-2">
                    <button id="bg-img-btn" onclick="setBackgroundType('image')" class="flex flex-col items-center justify-center p-2 rounded-xl border hover:bg-accent/50 transition-all cursor-pointer">
                        <i class="fa-solid fa-image text-xs mb-1"></i>
                        <span class="text-[9px] font-bold">Default Image</span>
                    </button>
                    <button id="bg-vid-btn" onclick="setBackgroundType('video')" class="flex flex-col items-center justify-center p-2 rounded-xl border hover:bg-accent/50 transition-all cursor-pointer">
                        <i class="fa-solid fa-circle-play text-xs mb-1"></i>
                        <span class="text-[9px] font-bold">Looping Video</span>
                    </button>
                    <button id="bg-grad-btn" onclick="setBackgroundType('gradient')" class="flex flex-col items-center justify-center p-2 rounded-xl border hover:bg-accent/50 transition-all cursor-pointer">
                        <i class="fa-solid fa-palette text-xs mb-1"></i>
                        <span class="text-[9px] font-bold">CSS Gradient</span>
                    </button>
                </div>
            </div>

            <!-- Video Selection -->
            <div id="video-select-section" class="space-y-3 hidden">
                <label class="text-[10px] font-bold text-muted-foreground uppercase tracking-wider">Select Background Video</label>
                <div class="space-y-2">
                    {{-- Local project videos (your downloaded ones!) --}}
                    <p class="text-[9px] font-bold text-primary uppercase tracking-widest">Your Project Videos</p>
                    <button onclick="setBgVideo('{{ asset('videos/dashboard.mp4') }}')" class="w-full flex items-center p-2.5 rounded-xl border border-border hover:bg-accent/50 text-left transition-all text-[11px] font-bold cursor-pointer">
                        <i class="fa-solid fa-gauge-high text-primary mr-3 text-sm"></i> Dashboard Video
                    </button>
                    <button onclick="setBgVideo('{{ asset('videos/analytics.mp4') }}')" class="w-full flex items-center p-2.5 rounded-xl border border-border hover:bg-accent/50 text-left transition-all text-[11px] font-bold cursor-pointer">
                        <i class="fa-solid fa-chart-pie text-primary mr-3 text-sm"></i> Analytics Video
                    </button>
                    <button onclick="setBgVideo('{{ asset('videos/history.mp4') }}')" class="w-full flex items-center p-2.5 rounded-xl border border-border hover:bg-accent/50 text-left transition-all text-[11px] font-bold cursor-pointer">
                        <i class="fa-solid fa-table-list text-primary mr-3 text-sm"></i> History Video
                    </button>
                    <button onclick="setBgVideo('{{ asset('videos/alerts.mp4') }}')" class="w-full flex items-center p-2.5 rounded-xl border border-border hover:bg-accent/50 text-left transition-all text-[11px] font-bold cursor-pointer">
                        <i class="fa-solid fa-bell text-primary mr-3 text-sm"></i> Alerts Video
                    </button>
                    <button onclick="setBgVideo('{{ asset('videos/add-usage.mp4') }}')" class="w-full flex items-center p-2.5 rounded-xl border border-border hover:bg-accent/50 text-left transition-all text-[11px] font-bold cursor-pointer">
                        <i class="fa-solid fa-plus text-primary mr-3 text-sm"></i> Add Usage Video
                    </button>
                    <button onclick="setBgVideo('{{ asset('videos/tips.mp4') }}')" class="w-full flex items-center p-2.5 rounded-xl border border-border hover:bg-accent/50 text-left transition-all text-[11px] font-bold cursor-pointer">
                        <i class="fa-solid fa-lightbulb text-primary mr-3 text-sm"></i> Tips Video
                    </button>
                    <button onclick="setBgVideo('{{ asset('videos/login.mp4') }}')" class="w-full flex items-center p-2.5 rounded-xl border border-border hover:bg-accent/50 text-left transition-all text-[11px] font-bold cursor-pointer">
                        <i class="fa-solid fa-leaf text-primary mr-3 text-sm"></i> Login Video
                    </button>

                    <p class="text-[9px] font-bold text-muted-foreground uppercase tracking-widest pt-2">Online Fallback Videos</p>
                    <button onclick="setBgVideo('https://assets.mixkit.co/videos/preview/mixkit-forest-stream-in-the-sunlight-529-large.mp4')" class="w-full flex items-center p-2.5 rounded-xl border border-border hover:bg-accent/50 text-left transition-all text-[11px] font-bold cursor-pointer">
                        <i class="fa-solid fa-water text-primary mr-3 text-sm"></i> Forest Stream (Eco)
                    </button>
                    <button onclick="setBgVideo('https://assets.mixkit.co/videos/preview/mixkit-solar-panels-in-a-field-3944-large.mp4')" class="w-full flex items-center p-2.5 rounded-xl border border-border hover:bg-accent/50 text-left transition-all text-[11px] font-bold cursor-pointer">
                        <i class="fa-solid fa-solar-panel text-primary mr-3 text-sm"></i> Solar Panels (Clean)
                    </button>

                    {{-- Custom URL input --}}
                    <div class="pt-2 space-y-1.5">
                        <label class="text-[9px] font-bold text-muted-foreground uppercase">Custom MP4 URL</label>
                        <div class="flex gap-2">
                            <input type="text" id="custom-video-url" placeholder="https://example.com/video.mp4" class="flex-1 text-xs rounded-lg border border-input bg-background/50 px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-primary">
                            <button onclick="applyCustomVideo()" class="bg-primary text-primary-foreground px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-primary/90 transition-all cursor-pointer">Apply</button>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border-border/60">

            <!-- Background Opacity -->
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <label class="text-[10px] font-bold text-muted-foreground uppercase tracking-wider">Background Opacity</label>
                    <span id="bg-opacity-val" class="text-xs font-bold text-foreground">90%</span>
                </div>
                <input type="range" id="bg-opacity-slider" min="10" max="100" step="5" class="w-full accent-primary cursor-pointer animate-none" oninput="setBgOpacity(this.value)">
            </div>

            <hr class="border-border/60">

            <!-- Card Opacity -->
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <label class="text-[10px] font-bold text-muted-foreground uppercase tracking-wider">Card Opacity (Glass)</label>
                    <span id="card-opacity-val" class="text-xs font-bold text-foreground">55%</span>
                </div>
                <input type="range" id="card-opacity-slider" min="10" max="100" step="5" class="w-full accent-primary cursor-pointer animate-none" oninput="setCardOpacity(this.value)">
            </div>

            <!-- Card Blur -->
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <label class="text-[10px] font-bold text-muted-foreground uppercase tracking-wider">Glass Blur Strength</label>
                    <span id="card-blur-val" class="text-xs font-bold text-foreground">12px</span>
                </div>
                <input type="range" id="card-blur-slider" min="0" max="24" step="1" class="w-full accent-primary cursor-pointer animate-none" oninput="setCardBlur(this.value)">
            </div>
        </div>

        <!-- Footer (Reset Settings) -->
        <div class="p-6 border-t border-border">
            <button onclick="resetAppearance()" class="w-full flex items-center justify-center space-x-2 py-2.5 text-xs font-bold border border-border hover:bg-accent text-foreground rounded-xl transition-all cursor-pointer">
                <i class="fa-solid fa-rotate-left"></i> <span>Reset to Defaults</span>
            </button>
        </div>
    </div>

    <!-- Customizer Overlay -->
    <div id="customizer-overlay" class="fixed inset-0 bg-black/40 z-40 hidden transition-opacity duration-300" onclick="toggleCustomizer()"></div>

    <!-- Scripts -->
    <script>
        // Sidebar drawer toggler for mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
            
            if (!sidebar.classList.contains('-translate-x-full')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        }

        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                overlay.classList.add('hidden');
                document.body.style.overflow = '';
            }
        });

        // UI Customizer Controls
        function toggleCustomizer() {
            const drawer = document.getElementById('customizer-drawer');
            const overlay = document.getElementById('customizer-overlay');
            drawer.classList.toggle('translate-x-full');
            overlay.classList.toggle('hidden');
        }

        function setAccentColor(color) {
            localStorage.setItem('su-accent-color', color);
            const style = document.getElementById('su-dynamic-variables');
            const colors = {
              green: { light: '142.5 76.2% 36.3%', dark: '142.5 70.6% 45.3%' },
              blue: { light: '221.2 83.2% 53.3%', dark: '217.2 91.2% 59.8%' },
              amber: { light: '37.7 92.1% 50.2%', dark: '37.7 90.1% 55.2%' },
              orange: { light: '24.6 95% 53.1%', dark: '24.6 90% 58.1%' },
              purple: { light: '271.5 81.3% 55.9%', dark: '271.5 85% 65%' },
              rose: { light: '346.8 77.2% 49.8%', dark: '346.8 80% 55.8%' }
            };
            const selected = colors[color] || colors.blue;
            const fontSize = localStorage.getItem('su-font-size') || '16';
            if (style) {
                style.innerHTML = `
                  :root {
                    --primary: ${selected.light} !important;
                    --ring: ${selected.light} !important;
                  }
                  .dark {
                    --primary: ${selected.dark} !important;
                    --ring: ${selected.dark} !important;
                  }
                  html {
                    font-size: calc(${fontSize}px - 2px) !important;
                  }
                  @media (min-width: 640px) {
                    html {
                      font-size: calc(${fontSize}px - 1px) !important;
                    }
                  }
                  @media (min-width: 1024px) {
                    html {
                      font-size: ${fontSize}px !important;
                    }
                  }
                `;
            }
            updateCustomizerButtons();
        }

        function setFontSize(val) {
            localStorage.setItem('su-font-size', val);
            const style = document.getElementById('su-dynamic-variables');
            if (style) {
                const themeColor = localStorage.getItem('su-accent-color') || 'blue';
                const colors = {
                  green: { light: '142.5 76.2% 36.3%', dark: '142.5 70.6% 45.3%' },
                  blue: { light: '221.2 83.2% 53.3%', dark: '217.2 91.2% 59.8%' },
                  amber: { light: '37.7 92.1% 50.2%', dark: '37.7 90.1% 55.2%' },
                  orange: { light: '24.6 95% 53.1%', dark: '24.6 90% 58.1%' },
                  purple: { light: '271.5 81.3% 55.9%', dark: '271.5 85% 65%' },
                  rose: { light: '346.8 77.2% 49.8%', dark: '346.8 80% 55.8%' }
                };
                const selected = colors[themeColor] || colors.blue;
                style.innerHTML = `
                  :root {
                    --primary: ${selected.light} !important;
                    --ring: ${selected.light} !important;
                  }
                  .dark {
                    --primary: ${selected.dark} !important;
                    --ring: ${selected.dark} !important;
                  }
                  html {
                    font-size: calc(${val}px - 2px) !important;
                  }
                  @media (min-width: 640px) {
                    html {
                      font-size: calc(${val}px - 1px) !important;
                    }
                  }
                  @media (min-width: 1024px) {
                    html {
                      font-size: ${val}px !important;
                    }
                  }
                `;
            }
        }

        function setLayoutMode(mode) {
            localStorage.setItem('su-layout-mode', mode);
            if (mode === 'floating') {
                document.body.classList.add('layout-floating');
            } else {
                document.body.classList.remove('layout-floating');
            }
            updateCustomizerButtons();
        }

        function setBackgroundType(type) {
            localStorage.setItem('su-bg-type', type);
            
            const videoEl = document.getElementById('bg-video');
            const imgEl = document.getElementById('bg-image');
            const gradEl = document.getElementById('bg-gradient');
            
            if (type === 'video') {
                document.getElementById('video-select-section').classList.remove('hidden');
                if (videoEl) {
                    const videoSrc = localStorage.getItem('su-bg-video-src') || '';
                    if (videoSrc) videoEl.src = videoSrc;
                    videoEl.classList.remove('hidden');
                    videoEl.style.display = 'block';
                    videoEl.load();
                    videoEl.play().catch(e => console.log('Video autoplay blocked, needs user interaction first'));
                }
                if (imgEl) imgEl.classList.add('hidden');
                if (gradEl) gradEl.classList.add('hidden');
            } else if (type === 'gradient') {
                document.getElementById('video-select-section').classList.add('hidden');
                if (gradEl) gradEl.classList.remove('hidden');
                if (imgEl) imgEl.classList.add('hidden');
                if (videoEl) videoEl.classList.add('hidden');
            } else {
                document.getElementById('video-select-section').classList.add('hidden');
                if (imgEl) imgEl.classList.remove('hidden');
                if (videoEl) videoEl.classList.add('hidden');
                if (gradEl) gradEl.classList.add('hidden');
            }
            updateCustomizerButtons();
        }

        function setBgVideo(src) {
            localStorage.setItem('su-bg-video-src', src);
            const videoEl = document.getElementById('bg-video');
            if (videoEl) {
                videoEl.src = src;
                videoEl.load();
                videoEl.play().catch(e => console.log('Video play failed:', e));
            }
            updateCustomizerButtons();
        }

        function applyCustomVideo() {
            const urlInput = document.getElementById('custom-video-url');
            if (urlInput && urlInput.value) {
                setBgVideo(urlInput.value);
            }
        }

        function setBgOpacity(val) {
            localStorage.setItem('su-bg-opacity', val);
            document.documentElement.style.setProperty('--bg-opacity', (val / 100).toFixed(2));
            document.getElementById('bg-opacity-val').textContent = val + '%';
        }

        function setCardOpacity(val) {
            localStorage.setItem('su-card-opacity', val);
            document.documentElement.style.setProperty('--card-opacity', (val / 100).toFixed(2));
            document.getElementById('card-opacity-val').textContent = val + '%';
        }

        function setCardBlur(val) {
            localStorage.setItem('su-card-blur', val);
            document.documentElement.style.setProperty('--card-blur', val + 'px');
            document.getElementById('card-blur-val').textContent = val + 'px';
        }

        function resetAppearance() {
            // Clear all saved preferences
            localStorage.removeItem('su-accent-color');
            localStorage.removeItem('su-font-size');
            localStorage.removeItem('su-layout-mode');
            localStorage.removeItem('su-bg-video-src');
            localStorage.removeItem('su-bg-opacity');
            localStorage.removeItem('su-card-opacity');
            localStorage.removeItem('su-card-blur');
            // Explicitly set video mode as default (not image!)
            localStorage.setItem('su-bg-type', 'video');
            window.location.reload();
        }

        function updateCustomizerButtons() {
            const accentColor = localStorage.getItem('su-accent-color') || 'blue';
            const fontSize = localStorage.getItem('su-font-size') || '16';
            const layoutMode = localStorage.getItem('su-layout-mode') || 'fullscreen';
            const bgType = localStorage.getItem('su-bg-type') || 'video';  // DEFAULT = video!
            const bgVideoSrc = localStorage.getItem('su-bg-video-src') || '';
            const bgOpacity = localStorage.getItem('su-bg-opacity') || '90';  // 90% — clearly visible!
            const cardOpacity = localStorage.getItem('su-card-opacity') || '55';  // 55% — glass effect
            const cardBlur = localStorage.getItem('su-card-blur') || '14';

            if (document.getElementById('font-size-slider')) document.getElementById('font-size-slider').value = fontSize;
            if (document.getElementById('bg-opacity-slider')) document.getElementById('bg-opacity-slider').value = bgOpacity;
            if (document.getElementById('card-opacity-slider')) document.getElementById('card-opacity-slider').value = cardOpacity;
            if (document.getElementById('card-blur-slider')) document.getElementById('card-blur-slider').value = cardBlur;

            if (document.getElementById('bg-opacity-val')) document.getElementById('bg-opacity-val').textContent = bgOpacity + '%';
            if (document.getElementById('card-opacity-val')) document.getElementById('card-opacity-val').textContent = cardOpacity + '%';
            if (document.getElementById('card-blur-val')) document.getElementById('card-blur-val').textContent = cardBlur + 'px';

            const fullBtn = document.getElementById('layout-full-btn');
            const floatBtn = document.getElementById('layout-float-btn');
            if (fullBtn && floatBtn) {
                if (layoutMode === 'fullscreen') {
                    fullBtn.className = "flex flex-col items-center justify-center p-3 rounded-xl border border-primary bg-primary/10 text-primary transition-all cursor-pointer";
                    floatBtn.className = "flex flex-col items-center justify-center p-3 rounded-xl border border-border hover:bg-accent/50 transition-all cursor-pointer";
                } else {
                    floatBtn.className = "flex flex-col items-center justify-center p-3 rounded-xl border border-primary bg-primary/10 text-primary transition-all cursor-pointer";
                    fullBtn.className = "flex flex-col items-center justify-center p-3 rounded-xl border border-border hover:bg-accent/50 transition-all cursor-pointer";
                }
            }

            const imgBtn = document.getElementById('bg-img-btn');
            const vidBtn = document.getElementById('bg-vid-btn');
            const gradBtn = document.getElementById('bg-grad-btn');
            if (imgBtn && vidBtn && gradBtn) {
                imgBtn.className = "flex flex-col items-center justify-center p-2 rounded-xl border hover:bg-accent/50 transition-all cursor-pointer " + (bgType === 'image' ? 'border-primary bg-primary/10 text-primary' : 'border-border');
                vidBtn.className = "flex flex-col items-center justify-center p-2 rounded-xl border hover:bg-accent/50 transition-all cursor-pointer " + (bgType === 'video' ? 'border-primary bg-primary/10 text-primary' : 'border-border');
                gradBtn.className = "flex flex-col items-center justify-center p-2 rounded-xl border hover:bg-accent/50 transition-all cursor-pointer " + (bgType === 'gradient' ? 'border-primary bg-primary/10 text-primary' : 'border-border');
            }

            const videoList = document.getElementById('video-select-section');
            if (videoList) {
                const buttons = videoList.getElementsByTagName('button');
                for (let btn of buttons) {
                    if (btn.outerHTML.includes(bgVideoSrc)) {
                        btn.className = "w-full flex items-center p-2.5 rounded-xl border border-primary bg-primary/10 text-primary text-left transition-all text-xs font-bold cursor-pointer";
                    } else if (!btn.outerHTML.includes('applyCustomVideo')) {
                        btn.className = "w-full flex items-center p-2.5 rounded-xl border border-border hover:bg-accent/50 text-left transition-all text-xs font-medium cursor-pointer";
                    }
                }
            }
        }

        window.addEventListener('DOMContentLoaded', () => {
            updateCustomizerButtons();
            const bgType = localStorage.getItem('su-bg-type') || 'video';  // Default = video!
            if (bgType === 'video') {
                document.getElementById('video-select-section').classList.remove('hidden');
            }
        });
    </script>

    @stack('scripts')

</body>
</html>
