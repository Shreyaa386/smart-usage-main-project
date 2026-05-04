@extends('layout')

@section('header', 'Add New Usage Record')

@section('content')
<div class="max-w-xl mx-auto bg-card border border-border/60 rounded-3xl shadow-lg p-10 transition-all duration-300">
    <div class="mb-8">
        <h3 class="text-2xl font-extrabold text-foreground tracking-tight">Log Consumption</h3>
        <p class="text-sm text-muted-foreground mt-2">Record a new reading for water or electricity usage.</p>
    </div>

    <form action="{{ route('add-usage.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="space-y-2">
            <label class="text-sm font-bold tracking-tight text-foreground/80 ml-1" for="device">
                Device / Location Name
            </label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-muted-foreground group-focus-within:text-primary transition-colors">
                    <i class="fa-solid fa-tag w-4"></i>
                </div>
                <input type="text" name="device" id="device" class="flex h-12 w-full rounded-xl border border-input bg-background px-4 py-2 pl-12 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 transition-all duration-200 hover:border-foreground/20" placeholder="e.g., Living Room AC, Kitchen Sink" required value="{{ old('device') }}">
            </div>
            @error('device') <span class="text-destructive text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
        </div>

        <div class="space-y-2">
            <label class="text-sm font-bold tracking-tight text-foreground/80 ml-1" for="type">
                Utility Type
            </label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-muted-foreground group-focus-within:text-primary transition-colors">
                    <i class="fa-solid fa-layer-group w-4"></i>
                </div>
                <select name="type" id="type" class="flex h-12 w-full rounded-xl border border-input bg-background px-4 py-2 pl-12 text-sm ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 transition-all duration-200 hover:border-foreground/20 appearance-none [&>option]:text-foreground [&>option]:bg-background" required>
                    <option value="" disabled selected>Select utility type...</option>
                    <option value="water" {{ old('type') == 'water' ? 'selected' : '' }}>Water (Liters)</option>
                    <option value="electricity" {{ old('type') == 'electricity' ? 'selected' : '' }}>Electricity (kWh)</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-muted-foreground">
                    <i class="fa-solid fa-chevron-down w-3"></i>
                </div>
            </div>
            @error('type') <span class="text-destructive text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
        </div>

        <div class="space-y-2">
            <label class="text-sm font-bold tracking-tight text-foreground/80 ml-1" for="usage">
                Usage Value
            </label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-muted-foreground group-focus-within:text-primary transition-colors">
                    <i class="fa-solid fa-gauge-high w-4"></i>
                </div>
                <input type="number" step="0.01" min="0" name="usage" id="usage" class="flex h-12 w-full rounded-xl border border-input bg-background px-4 py-2 pl-12 pr-16 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 transition-all duration-200 hover:border-foreground/20" placeholder="0.00" required value="{{ old('usage') }}">
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4">
                    <span id="unit-label" class="text-xs font-bold text-muted-foreground tracking-wider uppercase"></span>
                </div>
            </div>
            @error('usage') <span class="text-destructive text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
        </div>

        <div class="space-y-2">
            <label class="text-sm font-bold tracking-tight text-foreground/80 ml-1" for="period">
                Aggregation Period
            </label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-muted-foreground group-focus-within:text-primary transition-colors">
                    <i class="fa-solid fa-calendar-check w-4"></i>
                </div>
                <select name="period" id="period" class="flex h-12 w-full rounded-xl border border-input bg-background px-4 py-2 pl-12 text-sm ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 transition-all duration-200 hover:border-foreground/20 appearance-none [&>option]:text-foreground [&>option]:bg-background" required>
                    <option value="daily" {{ old('period') == 'daily' ? 'selected' : '' }}>Daily Reading</option>
                    <option value="weekly" {{ old('period') == 'weekly' ? 'selected' : '' }}>Weekly Aggregate</option>
                    <option value="monthly" {{ old('period') == 'monthly' ? 'selected' : '' }}>Monthly Aggregate</option>
                    <option value="yearly" {{ old('period') == 'yearly' ? 'selected' : '' }}>Yearly Aggregate</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-muted-foreground">
                    <i class="fa-solid fa-chevron-down w-3"></i>
                </div>
            </div>
            @error('period') <span class="text-destructive text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-border mt-8">
            <button type="reset" class="inline-flex items-center justify-center rounded-xl text-sm font-bold ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 text-foreground/70 hover:bg-muted h-12 px-6 py-2 active:scale-95">
                Clear
            </button>
            <button type="submit" class="inline-flex items-center justify-center rounded-xl text-sm font-extrabold ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-12 px-8 py-2 shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-[0.98]">
                <i class="fa-solid fa-check mr-2"></i> Save Record
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.getElementById('type');
        const unitLabel = document.getElementById('unit-label');

        function updateUnit() {
            if (typeSelect.value === 'water') {
                unitLabel.textContent = 'L';
            } else if (typeSelect.value === 'electricity') {
                unitLabel.textContent = 'kWh';
            } else {
                unitLabel.textContent = '';
            }
        }

        typeSelect.addEventListener('change', updateUnit);
        updateUnit();
    });
</script>
@endpush
