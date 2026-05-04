<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - smart-usage</title>
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
              card: { DEFAULT: "hsl(var(--card))", foreground: "hsl(var(--card-foreground))" },
              primary: { DEFAULT: "hsl(var(--primary))", foreground: "hsl(var(--primary-foreground))" },
              secondary: { DEFAULT: "hsl(var(--secondary))", foreground: "hsl(var(--secondary-foreground))" },
              muted: { DEFAULT: "hsl(var(--muted))", foreground: "hsl(var(--muted-foreground))" },
              accent: { DEFAULT: "hsl(var(--accent))", foreground: "hsl(var(--accent-foreground))" },
            },
            borderRadius: { lg: "var(--radius)", md: "calc(var(--radius) - 2px)", sm: "calc(var(--radius) - 4px)" }
          }
        }
      }
    </script>
    <style type="text/tailwindcss">
      @layer base {
        :root {
          --background: 0 0% 100%; --foreground: 224 71.4% 4.1%;
          --primary: 220.9 39.3% 11%; --primary-foreground: 210 20% 98%;
          --secondary: 220 14.3% 95.9%; --secondary-foreground: 220.9 39.3% 11%;
          --muted: 220 14.3% 95.9%; --muted-foreground: 220 8.9% 46.1%;
          --accent: 220 14.3% 95.9%; --accent-foreground: 220.9 39.3% 11%;
          --border: 220 13% 91%; --input: 220 13% 91%;
          --ring: 224 71.4% 4.1%; --radius: 0.5rem;
        }
        .dark {
          --background: 224 71.4% 4.1%; --foreground: 210 20% 98%;
          --primary: 210 20% 98%; --primary-foreground: 220.9 39.3% 11%;
          --secondary: 215 27.9% 16.9%; --secondary-foreground: 210 20% 98%;
          --muted: 215 27.9% 16.9%; --muted-foreground: 217.9 10.6% 64.9%;
          --border: 215 27.9% 16.9%; --input: 215 27.9% 16.9%; --ring: 216 12.2% 83.9%;
        }
        body { @apply bg-background text-foreground; }
      }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="antialiased min-h-screen flex bg-background selection:bg-primary/10 selection:text-primary">
    <!-- Left Side: Immersive Visual Section -->
    <div class="hidden md:block md:w-1/2 relative overflow-hidden bg-muted">
        <div class="absolute inset-0 z-10 bg-gradient-to-tr from-primary/20 via-transparent to-black/60"></div>
        <img 
            src="{{ asset('images/login-bg.png') }}" 
            alt="Sustainable Tech background" 
            class="absolute inset-0 h-full w-full object-cover scale-105 hover:scale-100 transition-transform duration-[10s] ease-out"
        />
        
        <div class="absolute top-12 left-12 z-20 flex items-center space-x-3">
            <div class="w-10 h-10 bg-white/20 backdrop-blur-md flex items-center justify-center rounded-xl border border-white/30">
                <i class="fa-solid fa-leaf text-white text-xl"></i>
            </div>
            <span class="text-2xl font-bold tracking-tight text-white">smart-usage</span>
        </div>

        <div class="absolute bottom-16 left-16 right-16 z-20">
            <h2 class="text-5xl font-extrabold text-white mb-6 leading-tight">Start your journey to sustainability.</h2>
            <p class="text-xl text-white/80 max-w-md">Join over 10,000+ users monitoring their footprint with precision and elegance.</p>
        </div>
    </div>

    <!-- Right Side: Signup Form Section -->
    <div class="w-full md:w-1/2 flex flex-col justify-center items-center p-8 md:p-24 relative z-10 bg-background">
        <div class="w-full max-w-[420px]">
            <div class="mb-10">
                <h1 class="text-4xl font-extrabold tracking-tight text-foreground mb-3">Create account</h1>
                <p class="text-muted-foreground text-base">Get started with your free account today.</p>
            </div>
            
            <form action="{{ route('signup.post') }}" method="POST" class="space-y-5">
                @csrf
                <div class="space-y-2">
                    <label class="text-sm font-semibold tracking-tight text-foreground/80 ml-1" for="name">Full Name</label>
                    <input class="flex h-12 w-full rounded-xl border border-input bg-background px-4 py-2 text-sm ring-offset-background placeholder:text-muted-foreground/50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 transition-all duration-200 hover:border-foreground/20" type="text" name="name" id="name" required placeholder="John Doe" value="{{ old('name') }}">
                    @error('name') <span class="text-destructive text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold tracking-tight text-foreground/80 ml-1" for="email">Email address</label>
                    <input class="flex h-12 w-full rounded-xl border border-input bg-background px-4 py-2 text-sm ring-offset-background placeholder:text-muted-foreground/50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 transition-all duration-200 hover:border-foreground/20" type="email" name="email" id="email" required placeholder="name@example.com" value="{{ old('email') }}">
                    @error('email') <span class="text-destructive text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-semibold tracking-tight text-foreground/80 ml-1" for="password">Password</label>
                    <input class="flex h-12 w-full rounded-xl border border-input bg-background px-4 py-2 text-sm ring-offset-background placeholder:text-muted-foreground/50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 transition-all duration-200 hover:border-foreground/20" type="password" name="password" id="password" required placeholder="••••••••">
                    @error('password') <span class="text-destructive text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold tracking-tight text-foreground/80 ml-1" for="password_confirmation">Confirm Password</label>
                    <input class="flex h-12 w-full rounded-xl border border-input bg-background px-4 py-2 text-sm ring-offset-background placeholder:text-muted-foreground/50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 transition-all duration-200 hover:border-foreground/20" type="password" name="password_confirmation" id="password_confirmation" required placeholder="••••••••">
                </div>
                
                <div class="pt-4">
                    <button class="inline-flex items-center justify-center rounded-xl text-sm font-bold ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 bg-primary text-primary-foreground hover:bg-primary/90 hover:scale-[1.02] active:scale-[0.98] h-12 px-8 py-2 w-full shadow-lg shadow-primary/20" type="submit">
                        Create account
                    </button>
                </div>
            </form>

            <div class="mt-8 flex items-center justify-center space-x-4">
                <div class="h-px flex-1 bg-border/60"></div>
                <span class="text-xs font-medium text-muted-foreground uppercase tracking-widest">Or sign up with</span>
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

            <p class="mt-10 text-center text-sm text-muted-foreground">
                Already have an account? <a href="{{ route('login') }}" class="font-bold text-foreground hover:text-primary transition-colors underline-offset-4 hover:underline">Sign in</a>
            </p>
        </div>
    </div>
</body>
</html>
