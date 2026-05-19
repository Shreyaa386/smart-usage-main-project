@extends('layout')

@section('header', 'Usage History')

@section('content')
@include('partials.page-background', ['bgImage' => 'images/data charts.avif', 'bgAlt' => 'History'])
<div class="mb-6 md:mb-8 flex space-x-2 bg-muted/30 p-1.5 rounded-2xl w-full md:w-fit border border-border/40 overflow-x-auto">
    <a href="{{ route('history', ['period' => 'day']) }}" class="px-4 md:px-6 py-1.5 md:py-2 text-xs font-bold rounded-xl transition-all whitespace-nowrap {{ (isset($period) && $period === 'day') ? 'bg-primary text-primary-foreground shadow-lg shadow-primary/20' : 'text-muted-foreground hover:text-foreground hover:bg-muted/50' }}">Today</a>
    <a href="{{ route('history', ['period' => 'month']) }}" class="px-4 md:px-6 py-1.5 md:py-2 text-xs font-bold rounded-xl transition-all whitespace-nowrap {{ (isset($period) && $period === 'month') ? 'bg-primary text-primary-foreground shadow-lg shadow-primary/20' : 'text-muted-foreground hover:text-foreground hover:bg-muted/50' }}">Month</a>
    <a href="{{ route('history', ['period' => 'year']) }}" class="px-4 md:px-6 py-1.5 md:py-2 text-xs font-bold rounded-xl transition-all whitespace-nowrap {{ (isset($period) && $period === 'year') ? 'bg-primary text-primary-foreground shadow-lg shadow-primary/20' : 'text-muted-foreground hover:text-foreground hover:bg-muted/50' }}">Year</a>
    <a href="{{ route('history', ['period' => 'all']) }}" class="px-4 md:px-6 py-1.5 md:py-2 text-xs font-bold rounded-xl transition-all whitespace-nowrap {{ (!isset($period) || $period === 'all') ? 'bg-primary text-primary-foreground shadow-lg shadow-primary/20' : 'text-muted-foreground hover:text-foreground hover:bg-muted/50' }}">All Time</a>
</div>

<div class="bg-card border border-border/60 rounded-2xl md:rounded-3xl shadow-md overflow-hidden transition-all duration-300">
    <div class="p-4 md:p-8 border-b border-border/60 flex flex-col sm:flex-row justify-between items-start sm:items-center bg-muted/10 gap-3">
        <div>
            <h3 class="text-lg md:text-xl font-extrabold tracking-tight">Consumption History</h3>
            <p class="text-xs text-muted-foreground mt-1">A detailed list of all recorded utility usage.</p>
        </div>
        <div class="px-3 md:px-4 py-1.5 md:py-2 bg-primary/5 border border-primary/10 rounded-xl text-primary text-xs font-bold tracking-widest uppercase">
            {{ $usages->count() }} Records
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="text-muted-foreground/60 uppercase text-[10px] font-extrabold tracking-widest border-b border-border/40">
                    <th class="px-4 md:px-8 py-4 md:py-5">Date & Time</th>
                    @if(Auth::user()->email === 'admin@gmail.com')
                        <th class="px-4 md:px-8 py-4 md:py-5 hidden sm:table-cell">User</th>
                    @endif
                    <th class="px-4 md:px-8 py-4 md:py-5">Device</th>
                    <th class="px-4 md:px-8 py-4 md:py-5 hidden sm:table-cell">Type</th>
                    <th class="px-4 md:px-8 py-4 md:py-5">Usage</th>
                    <th class="px-4 md:px-8 py-4 md:py-5 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="text-foreground divide-y divide-border/20">
                @forelse($usages as $usage)
                    <tr class="group hover:bg-muted/30 transition-all duration-200">
                        <td class="px-4 md:px-8 py-4 md:py-5 whitespace-nowrap text-muted-foreground text-xs font-medium">
                            {{ $usage->created_at->format('M d, Y') }} <span class="text-muted-foreground/40 ml-1 hidden sm:inline">{{ $usage->created_at->format('h:i A') }}</span>
                        </td>
                        @if(Auth::user()->email === 'admin@gmail.com')
                            <td class="px-4 md:px-8 py-4 md:py-5 hidden sm:table-cell">
                                <div class="flex items-center">
                                    <div class="w-6 h-6 rounded-full bg-primary/10 flex items-center justify-center mr-2 text-[8px] font-bold text-primary">
                                        {{ strtoupper(substr($usage->user->name ?? '?', 0, 1)) }}
                                    </div>
                                    <span class="text-xs font-bold text-foreground/70">{{ $usage->user->name ?? 'Unknown' }}</span>
                                </div>
                            </td>
                        @endif
                        <td class="px-4 md:px-8 py-4 md:py-5">
                            <span class="font-bold text-foreground/80 group-hover:text-primary transition-colors text-xs md:text-sm">{{ $usage->device }}</span>
                        </td>
                        <td class="px-4 md:px-8 py-4 md:py-5 hidden sm:table-cell">
                            @if($usage->type == 'water')
                                <span class="inline-flex items-center px-2 md:px-3 py-1 rounded-lg text-[10px] font-extrabold bg-water/5 text-water border border-water/10 tracking-widest uppercase">
                                    <i class="fa-solid fa-droplet mr-1 md:mr-2"></i> Water
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 md:px-3 py-1 rounded-lg text-[10px] font-extrabold bg-electricity/5 text-electricity border border-electricity/10 tracking-widest uppercase">
                                    <i class="fa-solid fa-bolt mr-1 md:mr-2"></i> Elec
                                </span>
                            @endif
                        </td>
                        <td class="px-4 md:px-8 py-4 md:py-5 tabular-nums">
                            <span class="text-sm md:text-base font-extrabold text-foreground">{{ number_format($usage->usage, 2) }}</span>
                            <span class="text-[10px] font-bold text-muted-foreground uppercase ml-1 tracking-widest">{{ $usage->type == 'water' ? 'L' : 'kWh' }}</span>
                        </td>
                        <td class="px-4 md:px-8 py-4 md:py-5 text-right">
                            <form action="{{ route('history.destroy', $usage->id) }}" method="POST" onsubmit="return confirm('Delete this record?');" class="inline-block">
                                @csrf
                                <button type="submit" class="text-muted-foreground/40 hover:text-destructive hover:bg-destructive/10 h-8 w-8 md:h-9 md:w-9 rounded-xl transition-all duration-200 flex items-center justify-center active:scale-90" title="Delete record">
                                    <i class="fa-solid fa-trash-can text-xs md:text-sm"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="h-16 w-16 bg-muted/30 rounded-3xl flex items-center justify-center mb-6">
                                    <i class="fa-solid fa-folder-open text-3xl text-muted-foreground/30"></i>
                                </div>
                                <p class="text-base font-extrabold text-foreground mb-1">No history found</p>
                                <p class="text-xs text-muted-foreground">Add some records to see your usage logs here.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
