@extends('layout')

@section('header', 'System Analytics')

@section('content')
@include('partials.page-background', ['bgVideo' => 'videos/analytics.mp4'])
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-8 mb-6 md:mb-8">
    <div class="md:col-span-2 bg-card border border-border/60 rounded-2xl md:rounded-3xl shadow-md p-4 sm:p-6 md:p-8 transition-all duration-300">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6 md:mb-8 gap-3">
            <div>
                <h3 class="text-lg md:text-xl font-extrabold tracking-tight">Device Usage Analysis</h3>
                <p class="text-xs text-muted-foreground mt-1">Comparing consumption patterns across all logged devices.</p>
            </div>
            <div class="h-10 w-10 bg-muted/50 rounded-xl flex items-center justify-center">
                <i class="fa-solid fa-microchip text-muted-foreground"></i>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-[10px] text-muted-foreground/60 uppercase font-extrabold tracking-widest border-b border-border/40">
                        <th class="pb-4">Device</th>
                        <th class="pb-4 text-center">Type</th>
                        <th class="pb-4 text-right">Total Aggregate</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border/20">
                    @forelse($deviceData as $data)
                        <tr class="group hover:bg-muted/30 transition-all duration-200">
                            <td class="py-5 font-bold text-foreground/80 group-hover:text-primary transition-colors">{{ $data->device }}</td>
                            <td class="py-5 text-center">
                                @if($data->type == 'water')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-[10px] font-extrabold bg-water/5 text-water border border-water/10 tracking-widest uppercase">Water</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-[10px] font-extrabold bg-electricity/5 text-electricity border border-electricity/10 tracking-widest uppercase">Elec</span>
                                @endif
                            </td>
                            <td class="py-5 text-right font-extrabold tabular-nums">
                                <span class="text-base text-foreground">{{ number_format($data->total_usage, 2) }}</span>
                                <span class="text-[10px] font-bold text-muted-foreground uppercase ml-1 tracking-widest">{{ $data->type == 'water' ? 'L' : 'kWh' }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-20 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fa-solid fa-chart-simple text-3xl text-muted-foreground/20 mb-4"></i>
                                    <p class="text-sm font-bold text-muted-foreground">No analytical data available.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="md:col-span-1 space-y-4 md:space-y-8">
        <!-- Highest Consumer Insight -->
        <div class="bg-card border border-border/60 rounded-2xl md:rounded-3xl shadow-md p-5 md:p-8 relative overflow-hidden group transition-all duration-300">
            <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full -mr-12 -mt-12 transition-transform group-hover:scale-110"></div>
            <h3 class="text-[10px] font-extrabold text-muted-foreground uppercase mb-6 tracking-widest relative z-10">Top Consumer</h3>
            @if($highestDevice)
                <div class="text-center relative z-10 mb-6">
                    <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-primary/20">
                        <i class="fa-solid fa-trophy text-2xl text-primary"></i>
                    </div>
                    <h4 class="text-2xl font-extrabold tracking-tight">{{ $highestDevice->device }}</h4>
                    <p class="text-[10px] font-bold text-muted-foreground tracking-widest uppercase mt-1">{{ $highestDevice->type }}</p>
                </div>
                <div class="bg-primary text-primary-foreground p-4 rounded-2xl text-center shadow-md shadow-primary/20">
                    <span class="text-3xl font-extrabold">{{ number_format($highestDevice->total_usage, 2) }}</span>
                    <span class="text-xs font-bold uppercase tracking-widest ml-1">{{ $highestDevice->type == 'water' ? 'L' : 'kWh' }}</span>
                </div>
            @else
                <div class="text-center py-10">
                    <p class="text-xs font-bold text-muted-foreground italic">Collecting insights...</p>
                </div>
            @endif
        </div>
        
        <!-- Insight Box -->
        <div class="bg-gradient-to-br from-primary via-primary/90 to-secondary rounded-2xl md:rounded-3xl shadow-md p-5 md:p-8 text-white relative overflow-hidden group">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-white/10 via-transparent to-transparent opacity-50"></div>
            <i class="fa-solid fa-lightbulb text-4xl text-yellow-300 mb-6 relative z-10 group-hover:scale-110 transition-transform"></i>
            <h3 class="text-lg font-extrabold mb-3 relative z-10 tracking-tight">Eco-Sustainability Tip</h3>
            <p class="text-sm text-white/80 leading-relaxed relative z-10">Reducing your electricity consumption during peak hours (2 PM - 6 PM) can significantly lower your carbon footprint and save water indirectly.</p>
        </div>
    </div>
</div>
@endsection
