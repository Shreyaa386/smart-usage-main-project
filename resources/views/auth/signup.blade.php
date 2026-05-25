<!DOCTYPE html>
<html lang="en" class="light">
<head>
    @include('partials.auth-head', ['title' => 'Sign Up - smart-usage'])
</head>
<body class="min-h-screen min-h-[100dvh] bg-transparent selection:bg-primary/10 selection:text-black">
    <video id="bg-video" autoplay loop muted playsinline class="fixed inset-0 w-full h-full object-cover -z-20" style="background-color:#000;">
        <source src="{{ asset('videos/login.mp4') }}" type="video/mp4">
        <img src="{{ asset('images/fallback.jpg') }}" alt="Background" class="w-full h-full object-cover" />
    </video>
    

<div class="flex flex-col min-h-screen min-h-[100dvh]">

    {{-- ======================================================================= --}}
    {{-- VIDEO PANEL: top banner on mobile/tablet, LEFT half on desktop          --}}
    {{-- This video is FULLY VISIBLE - not a faded background                   --}}
    {{-- ======================================================================= --}}
    <!-- Video panel removed; using layout background video -->

    {{-- ======================================================== --}}
    {{-- FORM PANEL: full width on mobile, right half on desktop  --}}
    {{-- ======================================================== --}}
    <div class="w-full min-h-[100dvh] flex flex-col justify-center items-center bg-black/30 backdrop-blur-sm rounded-lg p-6">

        <div class="w-full max-w-[420px] flex flex-col justify-center">

            {{-- Logo (shown only on mobile - desktop logo is on the video panel) --}}
            <a href="{{ route('login') }}" class="flex lg:hidden items-center space-x-2.5 sm:space-x-3 mb-6 sm:mb-8 self-start group">
                <div class="w-8 h-8 sm:w-9 sm:h-9 bg-primary flex items-center justify-center rounded-xl rotate-3 group-hover:rotate-0 transition-transform">
                    <i class="fa-solid fa-leaf text-primary-foreground text-base"></i>
                </div>
                <span class="text-lg sm:text-xl font-bold tracking-tight text-white">smart-usage</span>
            </a>

            {{-- Heading --}}
            <div class="mb-6 sm:mb-8">
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-white mb-1.5 sm:mb-2">Create account</h1>
                <p class="text-muted-muted-white text-xs sm:text-sm lg:text-base">Get started with your free account today.</p>
            </div>

            {{-- Signup form --}}
            <form action="{{ route('signup.post') }}" method="POST" class="space-y-4 sm:space-y-5">
                @csrf

                {{-- Full name --}}
                <div class="space-y-1.5">
                    <label class="text-xs sm:text-sm font-semibold tracking-tight text-white ml-1" for="name">Full Name</label>
                    <input
                        class="flex h-10 sm:h-11 lg:h-12 w-full rounded-xl border border-input bg-gray-800 px-4 py-2 text-xs sm:text-sm placeholder:text-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 transition-all hover:border-foreground/20"
                        type="text" name="name" id="name" required
                        placeholder="John Doe" value="{{ old('name') }}" autocomplete="name">
                    @error('name') <span class="text-destructive text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>

                {{-- Email --}}
                <div class="space-y-1.5">
                    <label class="text-xs sm:text-sm font-semibold tracking-tight text-white ml-1" for="email">Email address</label>
                    <input
                        class="flex h-10 sm:h-11 lg:h-12 w-full rounded-xl border border-input bg-gray-800 px-4 py-2 text-xs sm:text-sm placeholder:text-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 transition-all hover:border-foreground/20"
                        type="email" name="email" id="email" required
                        placeholder="name@example.com" value="{{ old('email') }}" autocomplete="email">
                    @error('email') <span class="text-destructive text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>

                {{-- Password --}}
                @include('partials.password-input', ['name' => 'password', 'label' => 'Password', 'value' => ''])

                {{-- Confirm password --}}
                @include('partials.password-input', ['name' => 'password_confirmation', 'label' => 'Confirm Password', 'value' => ''])

                {{-- Submit --}}
                <button
                    class="inline-flex items-center justify-center rounded-xl text-xs sm:text-sm font-bold h-10 sm:h-11 lg:h-12 w-full bg-primary text-primary-foreground hover:bg-primary/90 hover:scale-[1.02] active:scale-[0.98] shadow-lg shadow-primary/20 transition-all mt-2"
                    type="submit">
                    Create account
                </button>
            </form>

            @include('partials.social-login', ['dividerText' => 'Or sign up with'])

            <p class="mt-6 sm:mt-8 text-center text-xs sm:text-sm text-white pb-4">
                Already have an account? <a href="{{ route('login') }}" class="font-bold text-foreground hover:text-primary underline-offset-4 hover:underline">Sign in</a>
            </p>
        </div>
    </div>

</div>

@include('partials.auth-scripts')
</body>
</html>
