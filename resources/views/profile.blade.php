@extends('layout')

@section('header', 'Profile')

@section('content')
@include('partials.page-background', ['bgImage' => 'images/login-bg.png', 'bgAlt' => 'Profile'])
<div class="max-w-xl mx-auto bg-card shadow-md border border-border/60 rounded-2xl sm:rounded-3xl shadow-lg p-5 sm:p-8 md:p-10 transition-all duration-300">
    <div class="mb-6 sm:mb-8">
        <h3 class="text-xl sm:text-2xl font-extrabold text-foreground tracking-tight">Account Settings</h3>
        <p class="text-xs sm:text-sm text-muted-foreground mt-2">Manage your personal profile and account preferences.</p>
    </div>

    <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="space-y-2">
            <label class="text-sm font-bold tracking-tight text-foreground/80 ml-1" for="name">
                Full Name
            </label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-muted-foreground group-focus-within:text-primary transition-colors">
                    <i class="fa-regular fa-user w-4"></i>
                </div>
                <input type="text" name="name" id="name" class="flex h-12 w-full rounded-xl border border-input bg-background px-4 py-2 pl-12 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 transition-all duration-200 hover:border-foreground/20" value="{{ old('name', Auth::user()->name) }}" required>
            </div>
            @error('name') <span class="text-destructive text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
        </div>

        <div class="space-y-2">
            <label class="text-sm font-bold tracking-tight text-foreground/80 ml-1" for="email">
                Email Address
            </label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-muted-foreground group-focus-within:text-primary transition-colors">
                    <i class="fa-regular fa-envelope w-4"></i>
                </div>
                <input type="email" name="email" id="email" class="flex h-12 w-full rounded-xl border border-input bg-background px-4 py-2 pl-12 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 transition-all duration-200 hover:border-foreground/20" value="{{ old('email', Auth::user()->email) }}" required>
            </div>
            @error('email') <span class="text-destructive text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
        </div>

        <div class="border-t border-border pt-6 mt-6">
            <h4 class="text-sm font-bold text-foreground mb-4 flex items-center">
                <i class="fa-solid fa-bell mr-2 text-primary"></i>
                Usage Alert Limits
            </h4>
            <p class="text-xs text-muted-foreground mb-4">Set limits to receive alerts when your usage exceeds these values.</p>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-xs font-bold tracking-tight text-foreground/80 ml-1" for="water_limit">
                        Water Limit (Liters)
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-muted-foreground group-focus-within:text-water transition-colors">
                            <i class="fa-solid fa-droplet w-4"></i>
                        </div>
                        <input type="number" step="0.01" min="0" name="water_limit" id="water_limit" class="flex h-12 w-full rounded-xl border border-input bg-background px-4 py-2 pl-12 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 transition-all duration-200 hover:border-foreground/20" value="{{ old('water_limit', Auth::user()->water_limit ?? 100) }}" required>
                    </div>
                    @error('water_limit') <span class="text-destructive text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold tracking-tight text-foreground/80 ml-1" for="electricity_limit">
                        Electricity Limit (kWh)
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-muted-foreground group-focus-within:text-electricity transition-colors">
                            <i class="fa-solid fa-bolt w-4"></i>
                        </div>
                        <input type="number" step="0.01" min="0" name="electricity_limit" id="electricity_limit" class="flex h-12 w-full rounded-xl border border-input bg-background px-4 py-2 pl-12 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 transition-all duration-200 hover:border-foreground/20" value="{{ old('electricity_limit', Auth::user()->electricity_limit ?? 100) }}" required>
                    </div>
                    @error('electricity_limit') <span class="text-destructive text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-border mt-8">
            <button type="submit" class="inline-flex items-center justify-center rounded-xl text-sm font-extrabold ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-12 px-8 py-2 shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-[0.98]">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
