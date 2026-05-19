<!DOCTYPE html>
<html lang="en" class="light">
<head>
    @include('partials.auth-head', ['title' => 'Sign Up - smart-usage'])
</head>
<body class="min-h-screen min-h-[100dvh] flex flex-col lg:flex-row selection:bg-primary/10 selection:text-primary">

    {{-- Mobile & tablet background --}}
    <div class="fixed inset-0 lg:hidden z-0" aria-hidden="true">
        <img src="{{ asset('images/login-bg.png') }}" alt="" class="h-full w-full object-cover">
        <div class="absolute inset-0 bg-background/55 sm:bg-background/60"></div>
    </div>

    {{-- Desktop: hero (left) --}}
    <div class="hidden lg:block lg:w-1/2 relative overflow-hidden bg-muted min-h-[100dvh] order-first">
        <div class="absolute inset-0 z-10 bg-gradient-to-tr from-primary/20 via-transparent to-black/60"></div>
        <img src="{{ asset('images/login-bg.png') }}" alt="Sustainable technology" class="absolute inset-0 h-full w-full object-cover scale-105 hover:scale-100 transition-transform duration-[10s] ease-out">
        <div class="absolute top-12 left-12 z-20 flex items-center space-x-3">
            <div class="w-10 h-10 bg-white/20 backdrop-blur-md flex items-center justify-center rounded-xl border border-white/30">
                <i class="fa-solid fa-leaf text-white text-xl"></i>
            </div>
            <span class="text-2xl font-bold tracking-tight text-white">smart-usage</span>
        </div>
        <div class="absolute bottom-16 left-12 right-12 z-20">
            <h2 class="text-3xl xl:text-5xl font-extrabold text-white mb-4 md:mb-6 leading-tight">Start your journey to sustainability.</h2>
            <p class="text-base xl:text-xl text-white/80 max-w-md">Join users monitoring their footprint with precision and elegance.</p>
        </div>
    </div>

    {{-- Form panel --}}
    <div class="relative z-10 w-full lg:w-1/2 flex flex-col justify-center items-center px-4 py-8 sm:px-8 sm:py-10 md:px-12 lg:px-16 xl:px-24 lg:bg-background min-h-[100dvh]">
        <div class="w-full max-w-[420px] flex-1 lg:flex-none flex flex-col justify-center rounded-2xl border border-border/40 bg-card/95 backdrop-blur-md shadow-lg p-5 sm:p-6 lg:border-0 lg:bg-transparent lg:shadow-none lg:backdrop-blur-none lg:p-0 lg:rounded-none">
            <a href="{{ route('login') }}" class="flex lg:hidden items-center space-x-2.5 sm:space-x-3 mb-6 sm:mb-8 self-start group">
                <div class="w-8 h-8 sm:w-9 sm:h-9 bg-primary flex items-center justify-center rounded-xl rotate-3 group-hover:rotate-0 transition-transform">
                    <i class="fa-solid fa-leaf text-primary-foreground text-base"></i>
                </div>
                <span class="text-lg sm:text-xl font-bold tracking-tight text-foreground">smart-usage</span>
            </a>

            <div class="mb-6 sm:mb-8 md:mb-10">
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold tracking-tight text-foreground mb-1.5 sm:mb-2 md:mb-3">Create account</h1>
                <p class="text-muted-foreground text-sm sm:text-base">Get started with your free account today.</p>
            </div>

            <form action="{{ route('signup.post') }}" method="POST" class="space-y-4 sm:space-y-5">
                @csrf
                <div class="space-y-2">
                    <label class="text-xs sm:text-sm font-semibold tracking-tight text-foreground/80 ml-1" for="name">Full Name</label>
                    <input class="flex h-11 sm:h-12 w-full rounded-xl border border-input bg-background/90 lg:bg-background px-4 py-2 text-sm placeholder:text-muted-foreground/50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 transition-all hover:border-foreground/20" type="text" name="name" id="name" required placeholder="John Doe" value="{{ old('name') }}" autocomplete="name">
                    @error('name') <span class="text-destructive text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-xs sm:text-sm font-semibold tracking-tight text-foreground/80 ml-1" for="email">Email address</label>
                    <input class="flex h-11 sm:h-12 w-full rounded-xl border border-input bg-background/90 lg:bg-background px-4 py-2 text-sm placeholder:text-muted-foreground/50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 transition-all hover:border-foreground/20" type="email" name="email" id="email" required placeholder="name@example.com" value="{{ old('email') }}" autocomplete="email">
                    @error('email') <span class="text-destructive text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>

                @include('partials.password-input', ['name' => 'password', 'label' => 'Password', 'value' => ''])

                @include('partials.password-input', ['name' => 'password_confirmation', 'label' => 'Confirm Password', 'value' => ''])

                <button class="inline-flex items-center justify-center rounded-xl text-sm font-bold h-11 sm:h-12 w-full bg-primary text-primary-foreground hover:bg-primary/90 hover:scale-[1.02] active:scale-[0.98] shadow-lg shadow-primary/20 transition-all mt-2" type="submit">
                    Create account
                </button>
            </form>

            @include('partials.social-login', ['dividerText' => 'Or sign up with'])

            <p class="mt-8 sm:mt-10 text-center text-xs sm:text-sm text-muted-foreground pb-4">
                Already have an account? <a href="{{ route('login') }}" class="font-bold text-foreground hover:text-primary underline-offset-4 hover:underline">Sign in</a>
            </p>
        </div>
    </div>

    @include('partials.auth-scripts')
</body>
</html>
