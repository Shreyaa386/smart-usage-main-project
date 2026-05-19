{{-- Page background: visible image + scrim so foreground content stays readable. --}}
@php
    $bgImage = $bgImage ?? 'images/login-bg.png';
@endphp
<div class="fixed inset-0 -z-10 pointer-events-none" aria-hidden="true">
    <img
        src="{{ asset($bgImage) }}"
        alt=""
        class="w-full h-full object-cover opacity-[0.24] sm:opacity-[0.30] md:opacity-[0.36]"
    >
    <div class="absolute inset-0 bg-background/50 sm:bg-background/55"></div>
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_70%_at_50%_40%,transparent_0%,hsl(var(--background)/0.35)_55%,hsl(var(--background)/0.82)_100%)]"></div>
</div>
