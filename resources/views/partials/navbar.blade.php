@if(auth()->check())
<nav class="bg-black/30 backdrop-blur-md border-b border-border/40 px-4 py-2 md:px-6 md:py-3 flex items-center justify-between">
  <div class="flex items-center space-x-4">
    <a href="{{ route('dashboard') }}" class="text-white hover:text-primary font-semibold">Smart‑Usage</a>
  </div>
  <!-- Toggle button – visible on desktop (md:) -->
  <button id="nav-toggle" type="button" class="hidden md:inline-flex items-center p-2 rounded-md text-white hover:bg-white/10 focus:outline-none">
    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
  </button>
</nav>
<div id="nav-menu" class="hidden md:hidden bg-black/30 backdrop-blur-md border-b border-border/40 px-4 py-2">
  <ul class="space-y-2">
    <li><a href="{{ route('dashboard') }}" class="block text-white hover:text-primary">Dashboard</a></li>
    <li><a href="{{ route('add-usage') }}" class="block text-white hover:text-primary">Add Usage</a></li>
    <li><a href="{{ route('usage-history') }}" class="block text-white hover:text-primary">Usage History</a></li>
    <li><a href="{{ route('tips') }}" class="block text-white hover:text-primary">Tips</a></li>
    <li><a href="{{ route('profile') }}" class="block text-white hover:text-primary">Profile</a></li>
    <li><a href="{{ route('logout') }}" class="block text-white hover:text-primary">Logout</a></li>
  </ul>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('nav-toggle');
    const menu = document.getElementById('nav-menu');
    if (toggle && menu) {
      toggle.addEventListener('click', () => {
        menu.classList.toggle('hidden');
      });
    }
  });
</script>
@endif
