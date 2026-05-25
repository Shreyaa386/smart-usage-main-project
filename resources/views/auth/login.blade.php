<!DOCTYPE html>
<html lang="en" class="light">
<head>
    @include('partials.auth-head', ['title' => 'Login - smart-usage'])
</head>
<body class="min-h-screen min-h-[100dvh] bg-transparent selection:bg-primary/10 selection:text-primary">
    <video id="bg-video" autoplay loop muted playsinline class="fixed inset-0 w-full h-full object-cover -z-20" style="background-color:#000;">
        <source src="{{ asset('videos/login.mp4') }}" type="video/mp4">
        <img src="{{ asset('images/fallback.jpg') }}" alt="Background" class="w-full h-full object-cover" />
    </video>
    

<div class="flex flex-col min-h-screen min-h-[100dvh]">

    {{-- ======================================================= --}}
    {{-- FORM PANEL: full width on mobile, left half on desktop  --}}
    {{-- ======================================================= --}}
    

        <div class="w-full min-h-[100dvh] flex flex-col justify-center items-center bg-black/30 backdrop-blur-sm rounded-lg p-12">

            {{-- Logo --}}
            <a href="{{ route('login') }}" class="flex items-center space-x-2.5 sm:space-x-3 mb-6 sm:mb-8 self-start group">
                <div class="w-8 h-8 sm:w-9 sm:h-9 md:w-10 md:h-10 bg-primary flex items-center justify-center rounded-xl rotate-3 group-hover:rotate-0 transition-transform duration-300">
                    <i class="fa-solid fa-leaf text-primary-foreground text-base sm:text-lg"></i>
                </div>
                <span class="text-lg sm:text-xl md:text-2xl font-bold tracking-tight text-white">smart-usage</span>
            </a>

            {{-- Heading --}}
            <div class="mb-6 sm:mb-8">
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-white mb-1.5 sm:mb-2">Welcome</h1>
                <p class="text-muted-white text-xs sm:text-sm lg:text-base leading-relaxed">Enter your details below to access your workspace.</p>
            </div>

            {{-- Error alert --}}
            @if(session('error'))
                <div class="bg-destructive/10 text-destructive p-3 sm:p-4 rounded-xl mb-5 text-xs sm:text-sm border border-destructive/20 flex items-center gap-3">
                    <i class="fa-solid fa-circle-exclamation shrink-0"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            {{-- Login form --}}
            <form action="{{ route('login.post') }}" method="POST" class="space-y-4 sm:space-y-5">
                @csrf

                {{-- Email --}}
                <div class="space-y-1.5">
                    <label class="text-sm sm:text-base font-semibold tracking-tight text-white ml-1" for="email">Email address</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-white pointer-events-none">
                            <i class="fa-solid fa-envelope text-sm"></i>
                        </span>
                        <input
                            class="flex h-12 sm:h-14 lg:h-16 w-full rounded-xl border border-input bg-gray-800 pl-10 pr-4 py-3 text-sm sm:text-base text-white ring-offset-background placeholder:text-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 transition-all duration-200 hover:border-foreground/20"
                            type="email" name="email" id="email" required
                            placeholder="you@example.com" value="{{ old('email') }}" autocomplete="email">
                    </div>
                    @error('email') <span class="text-destructive text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>

                {{-- Password --}}
                <div class="space-y-1.5">
                    <div class="flex items-center justify-between ml-1">
                        <label class="text-sm sm:text-base font-semibold tracking-tight text-white" for="password">Password</label>
                        <a href="#" class="text-[10px] sm:text-xs font-medium text-primary hover:underline underline-offset-4">Forgot password?</a>
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-white pointer-events-none">
                            <i class="fa-solid fa-lock text-sm"></i>
                        </span>
                        <input
                            class="flex h-12 sm:h-14 lg:h-16 w-full rounded-xl border border-input bg-gray-800 pl-10 pr-12 py-3 text-sm sm:text-base text-white ring-offset-background placeholder:text-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 transition-all duration-200 hover:border-foreground/20"
                            type="password" name="password" id="password" required
                            placeholder="••••••••" autocomplete="current-password">
                        <button type="button" class="password-toggle absolute inset-y-0 right-0 flex items-center pr-3 sm:pr-4 text-white hover:text-foreground transition-colors" data-target="password" aria-label="Show password" aria-pressed="false">
                            <i class="fa-regular fa-eye text-base" aria-hidden="true"></i>
                        </button>
                    </div>
                    @error('password') <span class="text-destructive text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>

                {{-- Remember me --}}
                <div class="flex items-center space-x-3 ml-1">
                    <div class="relative flex items-center">
                        <input type="checkbox" id="remember" class="peer h-4 w-4 sm:h-5 sm:w-5 cursor-pointer appearance-none rounded-md border border-input transition-all checked:bg-primary checked:border-primary">
                        <i class="fa-solid fa-check absolute text-[9px] sm:text-[10px] text-primary-foreground opacity-0 peer-checked:opacity-100 top-0.5 left-1 sm:top-1 sm:left-1 pointer-events-none"></i>
                    </div>
                    <label for="remember" class="text-xs sm:text-sm font-medium text-white cursor-pointer">Keep me logged in</label>
                </div>

                {{-- Submit --}}
                <button class="inline-flex items-center justify-center rounded-xl text-xs sm:text-sm font-bold h-10 sm:h-11 lg:h-12 w-full bg-primary text-primary-foreground hover:bg-primary/90 hover:scale-[1.02] active:scale-[0.98] shadow-lg shadow-primary/20 transition-all mt-2" type="submit">
                    Sign In
                </button>
            </form>

            @include('partials.social-login', ['dividerText' => 'Or continue with'])

            <p class="mt-6 sm:mt-8 text-center text-xs sm:text-sm text-white">
                New to smart-usage? <a href="{{ route('signup') }}" class="font-bold text-foreground hover:text-primary underline-offset-4 hover:underline">Create an account</a>
            </p>
        </div>

        {{-- Footer --}}
        <footer class="w-full max-w-[400px] mt-8 pt-4 border-t border-border/40 flex flex-col xs:flex-row justify-center gap-2 text-[10px] font-medium text-muted-white uppercase tracking-wider">
            <span>&copy; 2026 Smart-Usage Inc.</span>
            <div class="flex gap-4">
                <a href="#" class="hover:text-blue">Privacy</a>
                <a href="#" class="hover:text-blue">Terms</a>
            </div>
        </footer>
    </div>

    {{-- ======================================================================= --}}
    {{-- VIDEO PANEL: top banner on mobile/tablet, right half on desktop         --}}
    {{-- This video is FULLY VISIBLE - not a faded background                   --}}
    {{-- ======================================================================= --}}
    <!-- Video panel removed; using layout background video -->

<!-- removed stray closing div -->

@include('partials.auth-scripts')
</body>
</html>
