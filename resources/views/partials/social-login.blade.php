@if(any_social_login_enabled())
    <div class="mt-6 sm:mt-8 flex items-center gap-3 sm:gap-4">
        <div class="h-px flex-1 bg-border/60"></div>
        <span class="text-[10px] sm:text-xs font-medium text-muted-foreground uppercase tracking-widest">{{ $dividerText ?? 'Or continue with' }}</span>
        <div class="h-px flex-1 bg-border/60"></div>
    </div>

    <div class="mt-6 sm:mt-8 grid grid-cols-1 {{ social_login_enabled('google') && social_login_enabled('github') ? 'sm:grid-cols-2' : '' }} gap-3 sm:gap-4">
        @if(social_login_enabled('google'))
            <a href="{{ route('social.redirect', 'google') }}" class="flex items-center justify-center gap-2 h-10 sm:h-11 rounded-xl border border-input bg-background/90 lg:bg-background hover:bg-accent text-xs sm:text-sm font-medium transition-colors">
                <i class="fa-brands fa-google"></i> Google
            </a>
        @endif
        @if(social_login_enabled('github'))
            <a href="{{ route('social.redirect', 'github') }}" class="flex items-center justify-center gap-2 h-10 sm:h-11 rounded-xl border border-input bg-background/90 lg:bg-background hover:bg-accent text-xs sm:text-sm font-medium transition-colors">
                <i class="fa-brands fa-github"></i> GitHub
            </a>
        @endif
    </div>
@endif
