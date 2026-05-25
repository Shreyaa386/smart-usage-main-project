{{-- Page background: visible video/image + scrim so foreground content stays readable. --}}
@php
    $bgVideo = $bgVideo ?? null;
    $bgImage = $bgImage ?? 'images/login-bg.png';
@endphp
<div class="fixed inset-0 -z-10 pointer-events-none" aria-hidden="true">
    @if($bgVideo)
        <video
            autoplay
            loop
            muted
            playsinline
            class="w-full h-full object-cover opacity-[0.20] sm:opacity-[0.25] md:opacity-[0.30]"
        >
            <source src="{{ asset($bgVideo) }}" type="video/mp4">
        </video>
    @else
        <img
            src="{{ asset($bgImage) }}"
            alt=""
            class="w-full h-full object-cover opacity-[0.24] sm:opacity-[0.30] md:opacity-[0.36]"
        >
    @endif
    <div class="absolute inset-0 bg-background/60 sm:bg-background/65"></div>
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_70%_at_50%_40%,transparent_0%,hsl(var(--background)/0.40)_55%,hsl(var(--background)/0.85)_100%)]"></div>
</div>
