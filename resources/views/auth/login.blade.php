<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - smart-usage</title>
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
          --primary: 220.9 39.3% 11%;
          --primary-foreground: 210 20% 98%;
          --secondary: 220 14.3% 95.9%;
          --secondary-foreground: 220.9 39.3% 11%;
          --muted: 220 14.3% 95.9%;
          --muted-foreground: 220 8.9% 46.1%;
          --accent: 220 14.3% 95.9%;
          --accent-foreground: 220.9 39.3% 11%;
          --border: 220 13% 91%;
          --input: 220 13% 91%;
          --ring: 224 71.4% 4.1%;
          --radius: 0.5rem;
        }
        .dark {
          --background: 224 71.4% 4.1%;
          --foreground: 210 20% 98%;
          --card: 224 71.4% 4.1%;
          --card-foreground: 210 20% 98%;
          --primary: 210 20% 98%;
          --primary-foreground: 220.9 39.3% 11%;
          --secondary: 215 27.9% 16.9%;
          --secondary-foreground: 210 20% 98%;
          --muted: 215 27.9% 16.9%;
          --muted-foreground: 217.9 10.6% 64.9%;
          --accent: 215 27.9% 16.9%;
          --accent-foreground: 210 20% 98%;
          --border: 215 27.9% 16.9%;
          --input: 215 27.9% 16.9%;
          --ring: 216 12.2% 83.9%;
        }
        body {
          @apply bg-background text-foreground;
        }
      }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="antialiased min-h-screen flex bg-background selection:bg-primary/10 selection:text-primary">
    <!-- Left Side: Interactive Login Section -->
    <div class="w-full md:w-1/2 flex flex-col justify-center items-center p-8 md:p-24 relative z-10 bg-background">
        <div class="absolute top-10 left-10 flex items-center space-x-3 group cursor-pointer">
            <div class="w-10 h-10 bg-primary flex items-center justify-center rounded-xl rotate-3 group-hover:rotate-0 transition-transform duration-300">
                <i class="fa-solid fa-leaf text-primary-foreground text-xl"></i>
            </div>
            <span class="text-2xl font-bold tracking-tight text-foreground">smart-usage</span>
        </div>
        
        <div class="w-full max-w-[400px]">
            <div class="mb-10 text-center md:text-left">
                <h1 class="text-4xl font-extrabold tracking-tight text-foreground mb-3">Welcome back</h1>
                <p class="text-muted-foreground text-base">Enter your details below to access your workspace.</p>
            </div>
            
            @if(session('error'))
                <div class="bg-destructive/10 text-destructive p-4 rounded-lg mb-8 text-sm border border-destructive/20 flex items-center gap-3">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                @csrf
                <div class="space-y-2">
                    <label class="text-sm font-semibold tracking-tight text-foreground/80 ml-1" for="email">Email address</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-muted-foreground">
                            <i class="fa-solid fa-envelope"></i>
                        </span>
                        <input class="flex h-12 w-full rounded-xl border border-input bg-background pl-10 pr-4 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground/50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 transition-all duration-200 hover:border-foreground/20" type="email" name="email" id="email" required placeholder="admin@gmail.com" value="">
                    </div>
                    @error('email') <span class="text-destructive text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>
                
                <div class="space-y-2">
                    <div class="flex items-center justify-between ml-1">
                        <label class="text-sm font-semibold tracking-tight text-foreground/80" for="password">Password</label>
                        <a href="#" class="text-xs font-medium text-primary hover:underline underline-offset-4 transition-all">Forgot password?</a>
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-muted-foreground">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input class="flex h-12 w-full rounded-xl border border-input bg-background pl-10 pr-4 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground/50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 transition-all duration-200 hover:border-foreground/20" type="password" name="password" id="password" required placeholder="••••••••" value="">
                    </div>
                    @error('password') <span class="text-destructive text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="flex items-center space-x-3 ml-1">
                    <div class="relative flex items-center">
                        <input type="checkbox" id="remember" class="peer h-5 w-5 cursor-pointer appearance-none rounded-md border border-input transition-all checked:bg-primary checked:border-primary">
                        <i class="fa-solid fa-check absolute text-[10px] text-primary-foreground opacity-0 peer-checked:opacity-100 top-1.5 left-1 pointer-events-none"></i>
                    </div>
                    <label for="remember" class="text-sm font-medium leading-none cursor-pointer peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-foreground/70">Keep me logged in</label>
                </div>
                
                <div class="pt-2">
                    <button class="inline-flex items-center justify-center rounded-xl text-sm font-bold ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 hover:scale-[1.02] active:scale-[0.98] h-12 px-8 py-2 w-full shadow-lg shadow-primary/20" type="submit">
                        Sign In
                    </button>
                </div>
            </form>

            <div class="mt-8 flex items-center justify-center space-x-4">
                <div class="h-px flex-1 bg-border/60"></div>
                <span class="text-xs font-medium text-muted-foreground uppercase tracking-widest">Or continue with</span>
                <div class="h-px flex-1 bg-border/60"></div>
            </div>

            <div class="mt-8 grid grid-cols-2 gap-4">
                <button class="flex items-center justify-center gap-2 h-11 rounded-xl border border-input bg-background hover:bg-accent transition-colors text-sm font-medium">
                    <i class="fa-brands fa-google"></i> Google
                </button>
                <button class="flex items-center justify-center gap-2 h-11 rounded-xl border border-input bg-background hover:bg-accent transition-colors text-sm font-medium">
                    <i class="fa-brands fa-github"></i> GitHub
                </button>
            </div>

            <!-- Admin Hint -->
            <div class="mt-8 p-4 bg-primary/5 border border-primary/10 rounded-2xl">
                <div class="flex items-center space-x-3 mb-2">
                    <i class="fa-solid fa-shield-halved text-primary text-sm"></i>
                    <span class="text-xs font-bold uppercase tracking-widest text-primary">Admin Access</span>
                </div>
                <p class="text-[11px] text-muted-foreground leading-relaxed">
                    Use <span class="font-bold text-foreground">admin@gmail.com</span> / <span class="font-bold text-foreground">admin123</span> to view all system usage data.
                </p>
            </div>

            <p class="mt-10 text-center text-sm text-muted-foreground">
                New to smart-usage? <a href="{{ route('signup') }}" class="font-bold text-foreground hover:text-primary transition-colors underline-offset-4 hover:underline">Create an account</a>
            </p>
        </div>
        
        <footer class="absolute bottom-10 left-10 right-10 flex justify-between text-[11px] font-medium text-muted-foreground uppercase tracking-wider">
            <span>&copy; 2026 Smart-Usage Inc.</span>
            <div class="flex space-x-4">
                <a href="#" class="hover:text-foreground">Privacy</a>
                <a href="#" class="hover:text-foreground">Terms</a>
            </div>
        </footer>
    </div>

    <!-- Right Side: Immersive Visual Section -->
    <div class="hidden md:block md:w-1/2 relative overflow-hidden bg-muted">
        <div class="absolute inset-0 z-10 bg-gradient-to-br from-primary/20 via-transparent to-black/60"></div>
        <img 
            src="{{ asset('images/login-bg.png') }}" 
            alt="Sustainable Tech background" 
            class="absolute inset-0 h-full w-full object-cover scale-105 hover:scale-100 transition-transform duration-[10s] ease-out"
        />
        
        <!-- Floating Elements for depth -->
        <div class="absolute top-20 right-20 w-32 h-32 bg-primary/30 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-40 -left-10 w-48 h-48 bg-secondary/20 rounded-full blur-3xl animate-pulse delay-700"></div>
    </div>
</body>
</html>
