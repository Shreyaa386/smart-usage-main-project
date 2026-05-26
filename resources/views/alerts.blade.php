@extends('layout')

@section('header', 'System Alerts')

@section('content')
@include('partials.page-background', ['bgVideo' => 'videos/alerts.mp4'])
<div class="max-w-4xl mx-auto space-y-4 md:space-y-6">
    <div class="bg-card border border-border/60 rounded-2xl md:rounded-3xl shadow-md p-4 sm:p-6 md:p-8 transition-all duration-300">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 md:mb-10 gap-3">
            <div>
                <h3 class="text-xl md:text-2xl font-extrabold tracking-tight">Consumption Alerts</h3>
                <p class="text-xs md:text-sm text-muted-foreground mt-2">Triggered for readings exceeding your custom limits (Water: {{ number_format($waterLimit, 2) }}L, Electricity: {{ number_format($electricityLimit, 2) }}kWh).</p>
            </div>
            <div class="px-4 md:px-5 py-1.5 md:py-2 bg-destructive/5 border border-destructive/10 rounded-xl text-destructive text-xs font-bold tracking-widest uppercase">
                {{ $highUsages->count() }} Alert(s)
            </div>
        </div>

        <div class="space-y-4">
            @forelse($highUsages as $alert)
                @php
                    $limit = $alert->type === 'water' ? $waterLimit : $electricityLimit;
                    $isCritical = $alert->usage > $limit;
                    $bgClass = $isCritical ? 'bg-destructive/5' : 'bg-amber-50 dark:bg-amber-900/5';
                    $borderClass = $isCritical ? 'border-destructive/20' : 'border-amber-500/20';
                    $textClass = $isCritical ? 'text-destructive' : 'text-amber-600 dark:text-amber-400';
                    $icon = $isCritical ? 'fa-triangle-exclamation' : 'fa-circle-exclamation';
                @endphp
                <div class="{{ $bgClass }} border {{ $borderClass }} p-4 md:p-6 rounded-xl md:rounded-2xl shadow-sm transition-all duration-200 group hover:scale-[1.01]">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-10 h-10 md:w-12 md:h-12 rounded-xl {{ $isCritical ? 'bg-destructive/10' : 'bg-amber-500/10' }} flex items-center justify-center">
                            <i class="fa-solid {{ $icon }} {{ $textClass }} text-lg md:text-xl"></i>
                        </div>
                        <div class="ml-4 md:ml-6 flex-1 min-w-0">
                            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-1 gap-1">
                                <h4 class="text-sm md:text-base font-extrabold {{ $textClass }} tracking-tight">
                                    @if($alert->type == 'water')
                                    Water usage exceeded {{ $waterLimit }}L limit
                                @elseif($alert->type == 'electricity')
                                    Electricity usage exceeded {{ $electricityLimit }} kWh limit
                                @else
                                    Usage exceeded limit
                                @endif
                                </h4>
                                <span class="text-[10px] text-muted-foreground font-bold tracking-widest uppercase">{{ $alert->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm text-foreground/80 leading-relaxed">
                                <span class="font-bold text-foreground">{{ $alert->device }}</span> reported a consumption of 
                                <span class="px-2 py-0.5 rounded-lg font-extrabold {{ $isCritical ? 'bg-destructive/10 text-destructive' : 'bg-amber-500/10 text-amber-600' }} ml-1">
                                    {{ number_format($alert->usage, 2) }} {{ $alert->type == 'water' ? 'L' : 'kWh' }}
                                </span>
                            </p>
                            <div class="mt-4 flex items-center text-[10px] font-bold text-muted-foreground uppercase tracking-widest">
                                <i class="fa-regular fa-calendar mr-2"></i>
                                Logged on {{ $alert->created_at->format('M d, Y') }} at {{ $alert->created_at->format('h:i A') }}
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-24 flex flex-col items-center">
                    <div class="w-20 h-20 bg-primary/5 rounded-3xl flex items-center justify-center mb-8 border border-primary/10">
                        <i class="fa-solid fa-check text-3xl text-primary/40"></i>
                    </div>
                    <h3 class="text-xl font-extrabold tracking-tight">System All Clear</h3>
                    <p class="text-sm text-muted-foreground mt-2 max-w-xs mx-auto">No abnormal usage patterns detected. Everything is within standard limits.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
