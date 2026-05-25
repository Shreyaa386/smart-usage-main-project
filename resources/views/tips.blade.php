@extends('layout')

@section('header', 'Energy & Water Saving Tips')

@section('content')
@include('partials.page-background', ['bgVideo' => 'videos/tips.mp4'])
<div class="max-w-6xl mx-auto space-y-6 md:space-y-8">
    <div class="bg-card border border-border/60 rounded-2xl md:rounded-3xl shadow-md p-4 sm:p-6 md:p-8 transition-all duration-300">
        <div class="text-center mb-8 md:mb-10">
            <div class="w-16 h-16 md:w-20 md:h-20 bg-primary/10 rounded-3xl flex items-center justify-center mx-auto mb-4 md:mb-6 border border-primary/20">
                <i class="fa-solid fa-lightbulb text-3xl md:text-4xl text-primary"></i>
            </div>
            <h3 class="text-2xl md:text-3xl font-extrabold tracking-tight mb-2 md:mb-3">Save Money, Save the Planet</h3>
            <p class="text-xs md:text-sm text-muted-foreground max-w-2xl mx-auto">Simple changes in your daily habits can lead to significant savings on your utility bills and help protect our environment.</p>
        </div>

        <!-- Water Saving Tips -->
        <div class="mb-8 md:mb-10">
            <div class="flex items-center mb-4 md:mb-6">
                <div class="w-10 h-10 md:w-12 md:h-12 bg-water/10 rounded-xl flex items-center justify-center mr-3 md:mr-4">
                    <i class="fa-solid fa-droplet text-lg md:text-xl text-water"></i>
                </div>
                <h4 class="text-lg md:text-xl font-extrabold text-foreground">Water Saving Tips</h4>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-4">
                <div class="bg-water/5 border border-water/10 rounded-xl md:rounded-2xl p-4 md:p-5 hover:bg-water/10 transition-all duration-200">
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-water/20 rounded-lg flex items-center justify-center mr-3 shrink-0">
                            <i class="fa-solid fa-shower text-water text-sm"></i>
                        </div>
                        <div>
                            <h5 class="text-sm md:text-base font-bold text-foreground mb-1">Shorter Showers</h5>
                            <p class="text-[10px] md:text-xs text-muted-foreground leading-relaxed">Reduce shower time by 2 minutes to save up to 10 gallons per shower.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-water/5 border border-water/10 rounded-xl md:rounded-2xl p-4 md:p-5 hover:bg-water/10 transition-all duration-200">
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-water/20 rounded-lg flex items-center justify-center mr-3 shrink-0">
                            <i class="fa-solid fa-faucet-drip text-water text-sm"></i>
                        </div>
                        <div>
                            <h5 class="text-sm md:text-base font-bold text-foreground mb-1">Fix Leaks Immediately</h5>
                            <p class="text-[10px] md:text-xs text-muted-foreground leading-relaxed">A dripping faucet can waste 3,000 gallons per year. Fix leaks promptly.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-water/5 border border-water/10 rounded-xl md:rounded-2xl p-4 md:p-5 hover:bg-water/10 transition-all duration-200">
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-water/20 rounded-lg flex items-center justify-center mr-3 shrink-0">
                            <i class="fa-solid fa-soap text-water text-sm"></i>
                        </div>
                        <div>
                            <h5 class="text-sm md:text-base font-bold text-foreground mb-1">Full Loads Only</h5>
                            <p class="text-[10px] md:text-xs text-muted-foreground leading-relaxed">Run dishwasher and washing machine only with full loads to maximize efficiency.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-water/5 border border-water/10 rounded-xl md:rounded-2xl p-4 md:p-5 hover:bg-water/10 transition-all duration-200">
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-water/20 rounded-lg flex items-center justify-center mr-3 shrink-0">
                            <i class="fa-solid fa-toilet text-water text-sm"></i>
                        </div>
                        <div>
                            <h5 class="text-sm md:text-base font-bold text-foreground mb-1">Install Low-Flow Fixtures</h5>
                            <p class="text-[10px] md:text-xs text-muted-foreground leading-relaxed">Low-flow showerheads and faucets can reduce water usage by 30-50%.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-water/5 border border-water/10 rounded-xl md:rounded-2xl p-4 md:p-5 hover:bg-water/10 transition-all duration-200">
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-water/20 rounded-lg flex items-center justify-center mr-3 shrink-0">
                            <i class="fa-solid fa-sink text-water text-sm"></i>
                        </div>
                        <div>
                            <h5 class="text-sm md:text-base font-bold text-foreground mb-1">Turn Off When Not in Use</h5>
                            <p class="text-[10px] md:text-xs text-muted-foreground leading-relaxed">Turn off taps while brushing teeth, shaving, or scrubbing dishes.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-water/5 border border-water/10 rounded-xl md:rounded-2xl p-4 md:p-5 hover:bg-water/10 transition-all duration-200">
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-water/20 rounded-lg flex items-center justify-center mr-3 shrink-0">
                            <i class="fa-solid fa-leaf text-water text-sm"></i>
                        </div>
                        <div>
                            <h5 class="text-sm md:text-base font-bold text-foreground mb-1">Water Plants Wisely</h5>
                            <p class="text-[10px] md:text-xs text-muted-foreground leading-relaxed">Water early morning or late evening to minimize evaporation loss.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Electricity Saving Tips -->
        <div>
            <div class="flex items-center mb-4 md:mb-6">
                <div class="w-10 h-10 md:w-12 md:h-12 bg-electricity/10 rounded-xl flex items-center justify-center mr-3 md:mr-4">
                    <i class="fa-solid fa-bolt text-lg md:text-xl text-electricity"></i>
                </div>
                <h4 class="text-lg md:text-xl font-extrabold text-foreground">Electricity Saving Tips</h4>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-4">
                <div class="bg-electricity/5 border border-electricity/10 rounded-xl md:rounded-2xl p-4 md:p-5 hover:bg-electricity/10 transition-all duration-200">
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-electricity/20 rounded-lg flex items-center justify-center mr-3 shrink-0">
                            <i class="fa-solid fa-temperature-low text-electricity text-sm"></i>
                        </div>
                        <div>
                            <h5 class="text-sm md:text-base font-bold text-foreground mb-1">Optimize Thermostat</h5>
                            <p class="text-[10px] md:text-xs text-muted-foreground leading-relaxed">Lower thermostat by 1°C to save up to 10% on heating bills.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-electricity/5 border border-electricity/10 rounded-xl md:rounded-2xl p-4 md:p-5 hover:bg-electricity/10 transition-all duration-200">
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-electricity/20 rounded-lg flex items-center justify-center mr-3 shrink-0">
                            <i class="fa-solid fa-lightbulb text-electricity text-sm"></i>
                        </div>
                        <div>
                            <h5 class="text-sm md:text-base font-bold text-foreground mb-1">Use LED Bulbs</h5>
                            <p class="text-[10px] md:text-xs text-muted-foreground leading-relaxed">LED bulbs use 75% less energy and last 25 times longer than incandescent.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-electricity/5 border border-electricity/10 rounded-xl md:rounded-2xl p-4 md:p-5 hover:bg-electricity/10 transition-all duration-200">
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-electricity/20 rounded-lg flex items-center justify-center mr-3 shrink-0">
                            <i class="fa-solid fa-plug text-electricity text-sm"></i>
                        </div>
                        <div>
                            <h5 class="text-sm md:text-base font-bold text-foreground mb-1">Unplug Devices</h5>
                            <p class="text-[10px] md:text-xs text-muted-foreground leading-relaxed">Unplug electronics when not in use to prevent phantom energy drain.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-electricity/5 border border-electricity/10 rounded-xl md:rounded-2xl p-4 md:p-5 hover:bg-electricity/10 transition-all duration-200">
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-electricity/20 rounded-lg flex items-center justify-center mr-3 shrink-0">
                            <i class="fa-solid fa-snowflake text-electricity text-sm"></i>
                        </div>
                        <div>
                            <h5 class="text-sm md:text-base font-bold text-foreground mb-1">Maintain AC Efficiency</h5>
                            <p class="text-[10px] md:text-xs text-muted-foreground leading-relaxed">Clean AC filters regularly and set temperature to 24-26°C for optimal efficiency.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-electricity/5 border border-electricity/10 rounded-xl md:rounded-2xl p-4 md:p-5 hover:bg-electricity/10 transition-all duration-200">
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-electricity/20 rounded-lg flex items-center justify-center mr-3 shrink-0">
                            <i class="fa-solid fa-sun text-electricity text-sm"></i>
                        </div>
                        <div>
                            <h5 class="text-sm md:text-base font-bold text-foreground mb-1">Natural Light</h5>
                            <p class="text-[10px] md:text-xs text-muted-foreground leading-relaxed">Maximize natural daylight during the day to reduce artificial lighting needs.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-electricity/5 border border-electricity/10 rounded-xl md:rounded-2xl p-4 md:p-5 hover:bg-electricity/10 transition-all duration-200">
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-electricity/20 rounded-lg flex items-center justify-center mr-3 shrink-0">
                            <i class="fa-solid fa-fan text-electricity text-sm"></i>
                        </div>
                        <div>
                            <h5 class="text-sm md:text-base font-bold text-foreground mb-1">Use Fans Instead of AC</h5>
                            <p class="text-[10px] md:text-xs text-muted-foreground leading-relaxed">Ceiling fans use 90% less energy than air conditioners. Use them when possible.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Banner -->
    <div class="bg-gradient-to-r from-primary/10 to-electricity/10 border border-primary/20 rounded-2xl md:rounded-3xl p-4 md:p-6 text-center">
        <p class="text-xs md:text-sm font-bold text-foreground mb-2">💡 Did You Know?</p>
        <p class="text-[10px] md:text-xs text-muted-foreground max-w-3xl mx-auto">Implementing these tips can reduce your utility bills by 20-30% annually while significantly reducing your carbon footprint.</p>
    </div>
</div>
@endsection
