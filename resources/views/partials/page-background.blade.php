{{-- Page background: supports static image, looping video, or animated CSS gradient --}}
{{-- Videos are clearly visible in both light & dark mode - your mam will see them! --}}
@php
    $bgImage = $bgImage ?? 'images/water-electricity theme.avif';
    $bgVideo = $bgVideo ?? 'videos/dashboard.mp4';
@endphp

<div id="bg-container" class="fixed inset-0 -z-10 pointer-events-none transition-all duration-500" aria-hidden="true" style="opacity: var(--bg-opacity, 0.90);">

    {{-- Static Image fallback --}}
    <img
        id="bg-image"
        src="{{ asset($bgImage) }}"
        alt=""
        class="absolute inset-0 w-full h-full object-cover transition-opacity duration-500 hidden pointer-events-none"
    >

    {{-- Looping Video — clearly visible background (not faded!) --}}
    <video
        id="bg-video"
        autoplay
        loop
        muted
        playsinline
        class="absolute inset-0 w-full h-full object-cover transition-opacity duration-500 pointer-events-none"
        style="display: block;"
    >
        <source src="{{ asset($bgVideo) }}" type="video/mp4">
        <source src="{{ asset('videos/dashboard.mp4') }}" type="video/mp4">
    </video>

    {{-- Animated CSS Gradient fallback --}}
    <div
        id="bg-gradient"
        class="absolute inset-0 hidden bg-gradient-to-br from-primary/30 via-primary/10 to-secondary/20 animate-pulse pointer-events-none"
    ></div>

    {{--
        KEY FIX: Use a DARK scrim (bg-black), NOT white (bg-background).
        In light mode, a white scrim = video invisible.
        A subtle black overlay makes video visible in BOTH light and dark modes!
        Light mode: 10% black = video pops with clarity
        Dark mode:  25% black = extra contrast for text readability
    --}}
    <div id="bg-scrim-1" class="absolute inset-0 bg-black/10 dark:bg-black/25 transition-all duration-300 pointer-events-none"></div>

    {{-- Very subtle bottom vignette only — keeps bottom text readable, doesn't hide the video --}}
    <div id="bg-scrim-2" class="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-t from-background/25 to-transparent pointer-events-none"></div>
</div>

<script>
    (function() {
        // Read saved settings from localStorage
        const bgType      = localStorage.getItem('su-bg-type')       || 'video';  // DEFAULT = video!
        const bgVideoSrc  = localStorage.getItem('su-bg-video-src')  || '{{ asset($bgVideo) }}';
        const bgOpacity   = localStorage.getItem('su-bg-opacity')    || '90'; // 90% — clearly visible!
        const cardOpacity = localStorage.getItem('su-card-opacity')  || '55'; // 55% — glass cards, video shows through
        const cardBlur    = localStorage.getItem('su-card-blur')     || '14'; // frosted glass blur

        // Apply immediately before paint — prevents flash
        document.documentElement.style.setProperty('--bg-opacity',   (bgOpacity   / 100).toFixed(2));
        document.documentElement.style.setProperty('--card-opacity', (cardOpacity / 100).toFixed(2));
        document.documentElement.style.setProperty('--card-blur',    cardBlur + 'px');

        function initBackground() {
            const videoEl = document.getElementById('bg-video');
            const imgEl   = document.getElementById('bg-image');
            const gradEl  = document.getElementById('bg-gradient');

            if (bgType === 'image' && imgEl) {
                imgEl.classList.remove('hidden');
                imgEl.style.display = 'block';
                if (videoEl) { videoEl.style.display = 'none'; videoEl.pause(); }
                if (gradEl)  gradEl.classList.add('hidden');

            } else if (bgType === 'gradient' && gradEl) {
                gradEl.classList.remove('hidden');
                if (imgEl)   imgEl.classList.add('hidden');
                if (videoEl) { videoEl.style.display = 'none'; videoEl.pause(); }

            } else {
                // Default = VIDEO MODE: fully visible, clearly playing
                if (videoEl) {
                    videoEl.src = bgVideoSrc;
                    videoEl.style.display = 'block';
                    videoEl.classList.remove('hidden');
                    videoEl.load();
                    videoEl.play().catch(e => {
                        // Autoplay blocked by browser — add click-to-play
                        console.log('Autoplay blocked, waiting for user interaction:', e);
                        document.addEventListener('click', () => videoEl.play(), { once: true });
                    });
                }
                if (imgEl)  imgEl.classList.add('hidden');
                if (gradEl) gradEl.classList.add('hidden');
            }
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initBackground);
        } else {
            initBackground();
        }
    })();
</script>
