<!DOCTYPE html>
<html lang="en" class="light">
<head>
    @include('partials.auth-head', ['title' => 'Login - smart-usage'])
</head>
<body class="min-h-screen min-h-[100dvh] flex flex-col lg:flex-row selection:bg-primary/10 selection:text-primary">

    {{-- Mobile & tablet: full-bleed background --}}
    <div class="fixed inset-0 lg:hidden z-0" aria-hidden="true">
        <img src="{{ asset('images/login-bg.png') }}" alt="" class="h-full w-full object-cover">
        <div class="absolute inset-0 bg-background/55 sm:bg-background/60"></div>
    </div>

    {{-- Form panel --}}
    <div class="relative z-10 w-full lg:w-1/2 flex flex-col justify-center items-center px-4 py-8 sm:px-8 sm:py-10 md:px-12 lg:px-16 xl:px-24 lg:bg-background min-h-[100dvh]">
        <div class="relative w-full max-w-[400px] flex flex-col min-h-0 flex-1 lg:flex-none justify-center rounded-2xl border border-border/40 bg-card/95 backdrop-blur-md shadow-lg p-5 sm:p-6 lg:border-0 lg:bg-transparent lg:shadow-none lg:backdrop-blur-none lg:p-0 lg:rounded-none">
            <a href="{{ route('login') }}" class="flex items-center space-x-2.5 sm:space-x-3 mb-6 sm:mb-8 self-start group">
                <div class="w-8 h-8 sm:w-9 sm:h-9 md:w-10 md:h-10 bg-primary flex items-center justify-center rounded-xl rotate-3 group-hover:rotate-0 transition-transform duration-300">
                    <i class="fa-solid fa-leaf text-primary-foreground text-base sm:text-lg"></i>
                </div>
                <span class="text-lg sm:text-xl md:text-2xl font-bold tracking-tight text-foreground">smart-usage</span>
            </a>

            <div class="mb-6 sm:mb-8 md:mb-10">
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold tracking-tight text-foreground mb-1.5 sm:mb-2 md:mb-3">Welcome back</h1>
                <p class="text-muted-foreground text-sm sm:text-base leading-relaxed">Enter your details below to access your workspace.</p>
            </div>

            @if(session('error'))
                <div class="bg-destructive/10 text-destructive p-3 sm:p-4 rounded-xl mb-6 sm:mb-8 text-xs sm:text-sm border border-destructive/20 flex items-center gap-3">
                    <i class="fa-solid fa-circle-exclamation shrink-0"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-5 sm:space-y-6">
                @csrf
                <div class="space-y-2">
                    <label class="text-xs sm:text-sm font-semibold tracking-tight text-foreground/80 ml-1" for="email">Email address</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-muted-foreground pointer-events-none">
                            <i class="fa-solid fa-envelope text-sm"></i>
                        </span>
                        <input class="flex h-11 sm:h-12 w-full rounded-xl border border-input bg-background/90 lg:bg-background pl-10 pr-4 py-2 text-sm ring-offset-background placeholder:text-muted-foreground/50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 transition-all duration-200 hover:border-foreground/20" type="email" name="email" id="email" required placeholder="you@example.com" value="{{ old('email') }}" autocomplete="email">
                    </div>
                    @error('email') <span class="text-destructive text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <div class="flex items-center justify-between ml-1">
                        <label class="text-xs sm:text-sm font-semibold tracking-tight text-foreground/80" for="password">Password</label>
                        <a href="#" class="text-[10px] sm:text-xs font-medium text-primary hover:underline underline-offset-4">Forgot password?</a>
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-muted-foreground pointer-events-none">
                            <i class="fa-solid fa-lock text-sm"></i>
                        </span>
                        <input class="flex h-11 sm:h-12 w-full rounded-xl border border-input bg-background/90 lg:bg-background pl-10 pr-12 py-2 text-sm ring-offset-background placeholder:text-muted-foreground/50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 transition-all duration-200 hover:border-foreground/20" type="password" name="password" id="password" required placeholder="••••••••" autocomplete="current-password">
                        <button type="button" class="password-toggle absolute inset-y-0 right-0 flex items-center pr-3 sm:pr-4 text-muted-foreground hover:text-foreground transition-colors" data-target="password" aria-label="Show password" aria-pressed="false">
                            <i class="fa-regular fa-eye text-base" aria-hidden="true"></i>
                        </button>
                    </div>
                    @error('password') <span class="text-destructive text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="flex items-center space-x-3 ml-1">
                    <div class="relative flex items-center">
                        <input type="checkbox" id="remember" class="peer h-4 w-4 sm:h-5 sm:w-5 cursor-pointer appearance-none rounded-md border border-input transition-all checked:bg-primary checked:border-primary">
                        <i class="fa-solid fa-check absolute text-[9px] sm:text-[10px] text-primary-foreground opacity-0 peer-checked:opacity-100 top-1 left-1 sm:top-1.5 sm:left-1 pointer-events-none"></i>
                    </div>
                    <label for="remember" class="text-xs sm:text-sm font-medium text-foreground/70 cursor-pointer">Keep me logged in</label>
                </div>

                <button class="inline-flex items-center justify-center rounded-xl text-sm font-bold h-11 sm:h-12 w-full bg-primary text-primary-foreground hover:bg-primary/90 hover:scale-[1.02] active:scale-[0.98] shadow-lg shadow-primary/20 transition-all" type="submit">
                    Sign In
                </button>
            </form>

            @include('partials.social-login', ['dividerText' => 'Or continue with'])

            <p class="mt-8 sm:mt-10 text-center text-xs sm:text-sm text-muted-foreground pb-2">
                New to smart-usage? <a href="{{ route('signup') }}" class="font-bold text-foreground hover:text-primary underline-offset-4 hover:underline">Create an account</a>
            </p>
        </div>

        <footer class="w-full max-w-[400px] mt-8 pt-4 border-t border-border/40 lg:border-0 flex flex-col xs:flex-row justify-between gap-2 text-[10px] sm:text-[11px] font-medium text-muted-foreground uppercase tracking-wider">
            <span>&copy; 2026 Smart-Usage Inc.</span>
            <div class="flex gap-4">
                <a href="#" class="hover:text-foreground">Privacy</a>
                <a href="#" class="hover:text-foreground">Terms</a>
            </div>
        </footer>
    </div>

    {{-- Desktop: hero image --}}
    <div class="hidden lg:block lg:w-1/2 relative overflow-hidden bg-muted min-h-[100dvh]">
        <div class="absolute inset-0 z-10 bg-gradient-to-br from-primary/20 via-transparent to-black/60"></div>
        <img src="{{ asset('images/login-bg.png') }}" alt="Sustainable technology" class="absolute inset-0 h-full w-full object-cover scale-105 hover:scale-100 transition-transform duration-[10s] ease-out">
        <div class="absolute top-20 right-20 w-32 h-32 bg-primary/30 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-40 -left-10 w-48 h-48 bg-secondary/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-16 left-12 right-12 z-20 hidden xl:block">
            <h2 class="text-4xl font-extrabold text-white mb-4 leading-tight">Track water &amp; electricity with clarity.</h2>
            <p class="text-lg text-white/80 max-w-md">Monitor consumption, spot trends, and build smarter habits.</p>
        </div>
    </div>

    @include('partials.auth-scripts')
</body>
</html>
