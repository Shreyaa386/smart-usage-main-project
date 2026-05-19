@extends('layout')

@section('header', 'System Dashboard')

@section('content')
@include('partials.page-background', ['bgImage' => 'images/water-electricity theme.avif', 'bgAlt' => 'Dashboard'])
<div class="mb-4 md:mb-6 flex space-x-2 overflow-x-auto bg-card rounded-xl px-2 py-2 shadow-sm border border-border/60">
    <a href="{{ route('dashboard', ['period' => 'day']) }}" class="px-3 md:px-4 py-1.5 md:py-2 text-xs md:text-sm font-medium rounded-md transition-colors whitespace-nowrap {{ (isset($period) && $period === 'day') ? 'bg-primary text-primary-foreground shadow-sm' : 'text-muted-foreground hover:bg-muted/50' }}">Today</a>
    <a href="{{ route('dashboard', ['period' => 'month']) }}" class="px-3 md:px-4 py-1.5 md:py-2 text-xs md:text-sm font-medium rounded-md transition-colors whitespace-nowrap {{ (isset($period) && $period === 'month') ? 'bg-primary text-primary-foreground shadow-sm' : 'text-muted-foreground hover:bg-muted/50' }}">This Month</a>
    <a href="{{ route('dashboard', ['period' => 'year']) }}" class="px-3 md:px-4 py-1.5 md:py-2 text-xs md:text-sm font-medium rounded-md transition-colors whitespace-nowrap {{ (isset($period) && $period === 'year') ? 'bg-primary text-primary-foreground shadow-sm' : 'text-muted-foreground hover:bg-muted/50' }}">This Year</a>
    <a href="{{ route('dashboard', ['period' => 'all']) }}" class="px-3 md:px-4 py-1.5 md:py-2 text-xs md:text-sm font-medium rounded-md transition-colors whitespace-nowrap {{ (!isset($period) || $period === 'all') ? 'bg-primary text-primary-foreground shadow-sm' : 'text-muted-foreground hover:bg-muted/50' }}">All Time</a>
</div>

@if(isset($suggestions) && count($suggestions) > 0)
<div class="mb-8">
    <h3 class="text-base sm:text-lg font-semibold tracking-tight text-foreground mb-3 sm:mb-4">Smart Suggestions</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($suggestions as $suggestion)
        <div class="flex items-center p-4 bg-card border {{ $suggestion['border'] }} rounded-xl shadow-sm transition-shadow hover:shadow-md">
            <div class="p-3 rounded-full {{ $suggestion['bg'] }} {{ $suggestion['color'] }} mr-4 shrink-0">
                <i class="{{ $suggestion['icon'] }} text-xl w-6 text-center"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-foreground leading-snug">{{ $suggestion['message'] }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6 md:mb-8">
    <!-- Total Water -->
    <div class="bg-card shadow-sm border border-border/60 rounded-2xl shadow-sm p-4 sm:p-6 relative overflow-hidden group hover:shadow-md transition-all duration-300">
        <div class="absolute top-0 right-0 w-24 h-24 bg-water/5 rounded-full -mr-8 -mt-8 transition-transform group-hover:scale-110"></div>
        <div class="flex items-center relative z-10">
            <div class="p-3 rounded-xl bg-water/10 text-water mr-4">
                <i class="fa-solid fa-droplet text-xl w-6 text-center"></i>
            </div>
            <div>
                <p class="text-[10px] text-muted-foreground font-bold uppercase tracking-widest mb-1">Total Water</p>
                <p class="text-2xl md:text-3xl font-extrabold text-foreground">{{ number_format($totalWater, 2) }} <span class="text-xs md:text-sm font-medium text-muted-foreground">L</span></p>
            </div>
        </div>
    </div>
    
    <!-- Total Electricity -->
    <div class="bg-card shadow-sm border border-border/60 rounded-2xl shadow-sm p-4 sm:p-6 relative overflow-hidden group hover:shadow-md transition-all duration-300">
        <div class="absolute top-0 right-0 w-24 h-24 bg-electricity/5 rounded-full -mr-8 -mt-8 transition-transform group-hover:scale-110"></div>
        <div class="flex items-center relative z-10">
            <div class="p-3 rounded-xl bg-electricity/10 text-electricity mr-4">
                <i class="fa-solid fa-bolt text-xl w-6 text-center"></i>
            </div>
            <div>
                <p class="text-[10px] text-muted-foreground font-bold uppercase tracking-widest mb-1">Total Electricity</p>
                <p class="text-2xl md:text-3xl font-extrabold text-foreground">{{ number_format($totalElectricity, 2) }} <span class="text-xs md:text-sm font-medium text-muted-foreground">kWh</span></p>
            </div>
        </div>
    </div>

    <!-- Water Consumption Status -->
    <div class="bg-card shadow-sm border border-border/60 rounded-2xl shadow-sm p-4 sm:p-6 hover:shadow-md transition-all duration-300">
        <div class="flex items-center justify-between mb-4">
            <p class="text-[10px] text-muted-foreground font-bold uppercase tracking-widest">Water Today</p>
            @if($todayWater > $yesterdayWater)
                <span class="flex items-center px-2 py-1 rounded-full bg-destructive/10 text-destructive text-[10px] font-bold">
                    <i class="fa-solid fa-arrow-up mr-1"></i> {{ $yesterdayWater > 0 ? round((($todayWater - $yesterdayWater) / $yesterdayWater) * 100) : 100 }}%
                </span>
            @else
                <span class="flex items-center px-2 py-1 rounded-full bg-secondary/10 text-secondary text-[10px] font-bold">
                    <i class="fa-solid fa-arrow-down mr-1"></i> Efficiency
                </span>
            @endif
        </div>
        <p class="text-2xl font-extrabold text-foreground">{{ number_format($todayWater, 2) }} <span class="text-xs font-medium text-muted-foreground">L</span></p>
        <p class="text-[10px] text-muted-foreground mt-2 font-medium">Yesterday: {{ number_format($yesterdayWater, 2) }} L</p>
    </div>

    <!-- Electricity Consumption Status -->
    <div class="bg-card shadow-sm border border-border/60 rounded-2xl shadow-sm p-4 sm:p-6 hover:shadow-md transition-all duration-300">
        <div class="flex items-center justify-between mb-4">
            <p class="text-[10px] text-muted-foreground font-bold uppercase tracking-widest">Elec Today</p>
            @if($todayElectricity > $yesterdayElectricity)
                <span class="flex items-center px-2 py-1 rounded-full bg-destructive/10 text-destructive text-[10px] font-bold">
                    <i class="fa-solid fa-arrow-up mr-1"></i> Up
                </span>
            @else
                <span class="flex items-center px-2 py-1 rounded-full bg-secondary/10 text-secondary text-[10px] font-bold">
                    <i class="fa-solid fa-arrow-down mr-1"></i> Down
                </span>
            @endif
        </div>
        <p class="text-2xl font-extrabold text-foreground">{{ number_format($todayElectricity, 2) }} <span class="text-xs font-medium text-muted-foreground">kWh</span></p>
        <p class="text-[10px] text-muted-foreground mt-2 font-medium">Yesterday: {{ number_format($yesterdayElectricity, 2) }} kWh</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-6 mb-6 md:mb-8">
    <!-- Line Chart Over Time -->
    <div class="bg-card border border-border rounded-xl shadow-md p-4 md:p-6">
        <h3 class="text-base md:text-lg font-semibold tracking-tight text-foreground mb-3 md:mb-4">Recent Usage Trends</h3>
        <canvas id="usageTimelineChart" height="200"></canvas>
    </div>

    <!-- Bar Chart By Device -->
    <div class="bg-card border border-border rounded-xl shadow-md p-4 md:p-6">
        <h3 class="text-base md:text-lg font-semibold tracking-tight text-foreground mb-3 md:mb-4">Device Consumption</h3>
        <canvas id="deviceBarChart" height="200"></canvas>
    </div>
</div>

@if(Auth::user()->email === 'admin@gmail.com')
<div class="mt-8 md:mt-12 bg-card border border-border/60 rounded-2xl md:rounded-3xl shadow-lg p-4 md:p-8 transition-all duration-300">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6 md:mb-8 gap-3">
        <div>
            <h3 class="text-lg md:text-xl font-extrabold tracking-tight">System User Overview</h3>
            <p class="text-xs text-muted-foreground mt-1">Summary of consumption across all registered users.</p>
        </div>
        <div class="h-10 w-10 bg-primary/10 rounded-xl flex items-center justify-center">
            <i class="fa-solid fa-users text-primary"></i>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="text-[10px] text-muted-foreground/60 uppercase font-extrabold tracking-widest border-b border-border/40">
                    <th class="pb-4">User</th>
                    <th class="pb-4">Email</th>
                    <th class="pb-4 text-right">Total Usage</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border/20">
                @foreach(\App\Models\User::withSum('usages', 'usage')->get() as $user)
                    <tr class="group hover:bg-muted/30 transition-all duration-200">
                        <td class="py-5">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center mr-3 text-[10px] font-bold text-primary">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <span class="font-bold text-foreground/80 group-hover:text-primary transition-colors">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="py-5 text-muted-foreground text-xs font-medium">{{ $user->email }}</td>
                        <td class="py-5 text-right font-extrabold tabular-nums">
                            <span class="text-base text-foreground">{{ number_format($user->usages_sum_usage ?? 0, 2) }}</span>
                            <span class="text-[10px] font-bold text-muted-foreground uppercase ml-1 tracking-widest">Units</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@if(Auth::user()->email === 'admin@gmail.com')
<div class="mt-8 flex justify-end">
    <form action="{{ route('admin.clear-cache') }}" method="POST">
        @csrf
        <button type="submit" class="inline-flex items-center space-x-2 px-4 py-2 bg-muted text-muted-foreground hover:bg-muted/80 rounded-xl text-xs font-bold transition-all active:scale-95 border border-border/60">
            <i class="fa-solid fa-broom"></i>
            <span>Refresh System Cache</span>
        </button>
    </form>
</div>
@endif
@endsection

@push('scripts')
<script>
    // Theme colors dynamically retrieved from CSS variable root/dark
    function getCssVar(name) {
        return getComputedStyle(document.documentElement).getPropertyValue(name).trim();
    }
    
    // Construct HSL string
    function hslVar(name) {
        let val = getCssVar(name);
        if(!val) return null;
        if (val.includes('%')) {
          val = val.replace(/,/g, '');
        }
        return `hsl(${val})`;
    }

    const waterColor = hslVar('--water') || '#3b82f6';
    const elecColor = hslVar('--electricity') || '#f59e0b';
    const gridColor = document.documentElement.classList.contains('dark') ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)';
    const textColor = document.documentElement.classList.contains('dark') ? 'rgba(255, 255, 255, 0.7)' : 'rgba(0, 0, 0, 0.7)';

    const rawTimeline = @json($recentUsages->reverse()->values());
    const labels = rawTimeline.map(item => new Date(item.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'}));
    
    const waterData = rawTimeline.map(item => item.type === 'water' ? item.usage : 0);
    const elecData = rawTimeline.map(item => item.type === 'electricity' ? item.usage : 0);

    const ctxLine = document.getElementById('usageTimelineChart').getContext('2d');
    const usageLineChart = new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: labels.length ? labels : ['No Data'],
            datasets: [
                {
                    label: 'Water (L)',
                    data: waterData.length ? waterData : [0],
                    borderColor: waterColor,
                    backgroundColor: waterColor,
                    borderWidth: 2,
                    tension: 0.3,
                    fill: false
                },
                {
                    label: 'Electricity (kWh)',
                    data: elecData.length ? elecData : [0],
                    borderColor: elecColor,
                    backgroundColor: elecColor,
                    borderWidth: 2,
                    tension: 0.3,
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            scales: { 
                y: { 
                    beginAtZero: true,
                    grid: { color: gridColor },
                    ticks: { color: textColor }
                },
                x: {
                    grid: { color: gridColor },
                    ticks: { color: textColor }
                }
            },
            plugins: {
                legend: { labels: { color: textColor } }
            }
        }
    });

    const rawDevices = @json($deviceUsage);
    const deviceLabels = rawDevices.map(item => item.device + ' (' + item.percentage + '%)');
    const deviceTotals = rawDevices.map(item => item.total_usage);
    const deviceColors = rawDevices.map(item => item.type === 'water' ? waterColor : elecColor);

    const ctxBar = document.getElementById('deviceBarChart').getContext('2d');
    const deviceChart = new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: deviceLabels.length ? deviceLabels : ['No Data'],
            datasets: [{
                label: 'Total Consumed',
                data: deviceTotals.length ? deviceTotals : [0],
                backgroundColor: deviceColors.length ? deviceColors : ['#ccc'],
                borderWidth: 0,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            scales: { 
                y: { 
                    beginAtZero: true,
                    grid: { color: gridColor },
                    ticks: { color: textColor }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: textColor }
                }
            },
            plugins: { legend: { display: false } }
        }
    });
</script>
@endpush
