<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UsageController extends Controller
{
    private function baseQuery()
    {
        if (Auth::check() && Auth::user()->email === 'admin@gmail.com') {
            return Usage::query();
        }
        return Usage::where('user_id', Auth::id());
    }

    public function dashboard(Request $request)
    {
        $period = $request->query('period', 'all'); // day, month, year, all

        $queryWater = $this->baseQuery()->where('type', 'water');
        $queryElec = $this->baseQuery()->where('type', 'electricity');

        $chartQuery = $this->baseQuery();
        $deviceQuery = $this->baseQuery();

        if ($period === 'day') {
            $queryWater->whereDate('created_at', Carbon::today());
            $queryElec->whereDate('created_at', Carbon::today());
            $chartQuery->whereDate('created_at', Carbon::today());
            $deviceQuery->whereDate('created_at', Carbon::today());
            
            $todayWater = $this->baseQuery()->where('type', 'water')->whereDate('created_at', Carbon::today())->sum('usage');
            $yesterdayWater = $this->baseQuery()->where('type', 'water')->whereDate('created_at', Carbon::yesterday())->sum('usage');
            $todayElectricity = $this->baseQuery()->where('type', 'electricity')->whereDate('created_at', Carbon::today())->sum('usage');
            $yesterdayElectricity = $this->baseQuery()->where('type', 'electricity')->whereDate('created_at', Carbon::yesterday())->sum('usage');
        } elseif ($period === 'month') {
            $queryWater->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year);
            $queryElec->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year);
            $chartQuery->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year);
            $deviceQuery->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year);
            
            $todayWater = clone $queryWater; $todayWater = $todayWater->sum('usage');
            $yesterdayWater = $this->baseQuery()->where('type', 'water')->whereMonth('created_at', Carbon::now()->subMonth()->month)->whereYear('created_at', Carbon::now()->subMonth()->year)->sum('usage');
            $todayElectricity = clone $queryElec; $todayElectricity = $todayElectricity->sum('usage');
            $yesterdayElectricity = $this->baseQuery()->where('type', 'electricity')->whereMonth('created_at', Carbon::now()->subMonth()->month)->whereYear('created_at', Carbon::now()->subMonth()->year)->sum('usage');
        } elseif ($period === 'year') {
            $queryWater->whereYear('created_at', Carbon::now()->year);
            $queryElec->whereYear('created_at', Carbon::now()->year);
            $chartQuery->whereYear('created_at', Carbon::now()->year);
            $deviceQuery->whereYear('created_at', Carbon::now()->year);
            
            $todayWater = clone $queryWater; $todayWater = $todayWater->sum('usage');
            $yesterdayWater = $this->baseQuery()->where('type', 'water')->whereYear('created_at', Carbon::now()->subYear()->year)->sum('usage');
            $todayElectricity = clone $queryElec; $todayElectricity = $todayElectricity->sum('usage');
            $yesterdayElectricity = $this->baseQuery()->where('type', 'electricity')->whereYear('created_at', Carbon::now()->subYear()->year)->sum('usage');
        } else {
            // all time
            $todayWater = $this->baseQuery()->where('type', 'water')->whereDate('created_at', Carbon::today())->sum('usage');
            $yesterdayWater = $this->baseQuery()->where('type', 'water')->whereDate('created_at', Carbon::yesterday())->sum('usage');
            $todayElectricity = $this->baseQuery()->where('type', 'electricity')->whereDate('created_at', Carbon::today())->sum('usage');
            $yesterdayElectricity = $this->baseQuery()->where('type', 'electricity')->whereDate('created_at', Carbon::yesterday())->sum('usage');
        }

        $totalWater = $queryWater->sum('usage');
        $totalElectricity = $queryElec->sum('usage');

        // Data for charts
        // Taking 30 for broader view if monthly/yearly, otherwise 10
        $takeLimit = in_array($period, ['month', 'year', 'all']) ? 30 : 10;
        $recentUsages = $chartQuery->orderBy('created_at', 'desc')->take($takeLimit)->get();
        
        $deviceUsage = $deviceQuery->selectRaw('device, sum(`usage`) as total_usage, type')
            ->groupBy('device', 'type')
            ->get();

        $highestDevice = $deviceUsage->sortByDesc('total_usage')->first();
        $suggestions = $this->getSuggestions($totalWater, $totalElectricity, $highestDevice);
        
        // Check if today's usage exceeds limits for notification
        $user = Auth::user();
        $waterLimit = $user->water_limit ?? 500;
        $electricityLimit = $user->electricity_limit ?? 10;
        $exceedsWaterLimit = $todayWater > $waterLimit;
        $exceedsElectricityLimit = $todayElectricity > $electricityLimit;
        
        // Add percentage calculation
        foreach ($deviceUsage as $device) {
            if ($device->type === 'water' && $totalWater > 0) {
                $device->percentage = round(($device->total_usage / $totalWater) * 100);
            } elseif ($device->type === 'electricity' && $totalElectricity > 0) {
                $device->percentage = round(($device->total_usage / $totalElectricity) * 100);
            } else {
                $device->percentage = 0;
            }
        }

        return view('dashboard', compact(
            'totalWater', 'totalElectricity', 
            'todayWater', 'yesterdayWater', 
            'todayElectricity', 'yesterdayElectricity',
            'recentUsages', 'deviceUsage', 'period', 'suggestions', 'highestDevice',
            'waterLimit', 'electricityLimit', 'exceedsWaterLimit', 'exceedsElectricityLimit'
        ));
    }

    public function create()
    {
        return view('add-usage');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'device' => 'required|string|max:255',
            'type' => 'required|in:water,electricity',
            'usage' => 'required|numeric|min:0',
            'period' => 'required|in:daily,weekly,monthly,yearly',
        ]);

        $data['user_id'] = Auth::id();

        Usage::create($data);

        return redirect()->route('dashboard')->with('success', 'Usage data added successfully!');
    }

    public function history(Request $request)
    {
        $period = $request->query('period', 'all');
        $query = $this->baseQuery()->with('user')->orderBy('created_at', 'desc');

        if ($period === 'day') {
            $query->whereDate('created_at', Carbon::today());
        } elseif ($period === 'month') {
            $query->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year);
        } elseif ($period === 'year') {
            $query->whereYear('created_at', Carbon::now()->year);
        }

        $usages = $query->orderBy('created_at', 'desc')->get();
        return view('usage-history', compact('usages', 'period'));
    }

    public function destroy($id)
    {
        // Ensure user owns usage
        $usage = $this->baseQuery()->findOrFail($id);
        $usage->delete();
        return back()->with('success', 'Record deleted successfully!');
    }

    public function analytics()
    {
        $deviceData = $this->baseQuery()->selectRaw('device, sum(`usage`) as total_usage, type')
            ->groupBy('device', 'type')
            ->orderBy('total_usage', 'desc')
            ->get();

        $highestDevice = $deviceData->first();

        return view('analytics', compact('deviceData', 'highestDevice'));
    }

    public function alerts()
    {
        $user = Auth::user();
        $waterLimit = $user->water_limit ?? 500; // Updated default water limit
        $electricityLimit = $user->electricity_limit ?? 10; // Updated default electricity limit
        
        $highUsages = $this->baseQuery()
            ->where(function($query) use ($waterLimit, $electricityLimit) {
                $query->where(function($q) use ($waterLimit) {
                    $q->where('type', 'water')->where('usage', '>', $waterLimit);
                })->orWhere(function($q) use ($electricityLimit) {
                    $q->whereIn('type', ['electricity', 'Electricity'])->where('usage', '>', $electricityLimit);
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('alerts', compact('highUsages', 'waterLimit', 'electricityLimit'));
    }

    private function getSuggestions($totalWater, $totalElectricity, $highestDevice)
    {
        $suggestions = [];
        $user = Auth::user();
        $waterLimit = $user->water_limit ?? 100;
        $electricityLimit = $user->electricity_limit ?? 100;

        if ($totalWater > $waterLimit) {
            $suggestions[] = [
                'type' => 'water',
                'message' => "Water usage ({$totalWater}L) exceeds your limit ({$waterLimit}L). Try reducing wastage.",
                'icon' => 'fa-solid fa-droplet',
                'color' => 'text-water',
                'bg' => 'bg-water/10',
                'border' => 'border-water/20'
            ];
        }

        if ($totalElectricity > $electricityLimit) {
            $suggestions[] = [
                'type' => 'electricity',
                'message' => "Electricity usage ({$totalElectricity}kWh) exceeds your limit ({$electricityLimit}kWh). Turn off unused devices.",
                'icon' => 'fa-solid fa-bolt',
                'color' => 'text-electricity',
                'bg' => 'bg-electricity/10',
                'border' => 'border-electricity/20'
            ];
        }

        if ($highestDevice) {
            $suggestions[] = [
                'type' => 'warning',
                'message' => "{$highestDevice->device} is consuming the most resources. Consider reducing its usage.",
                'icon' => 'fa-solid fa-lightbulb',
                'color' => 'text-yellow-600 dark:text-yellow-400',
                'bg' => 'bg-yellow-50 dark:bg-yellow-900/20',
                'border' => 'border-yellow-200 dark:border-yellow-800'
            ];
        }

        return $suggestions;
    }
}
