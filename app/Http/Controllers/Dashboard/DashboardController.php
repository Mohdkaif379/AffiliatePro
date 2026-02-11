<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OfferClick;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        if (!session()->has('email')) {
            return redirect()->route('login');
        }

        $filter   = $request->filter ?? 'today';
        $fromDate = $request->from_date;
        $toDate   = $request->to_date;

        $query = OfferClick::query();

        // ✅ Role check
        $roleName = strtolower(auth()->user()->roleDetail->name);

        // ✅ Sirf non-admin ke liye user_id filter
        if ($roleName !== 'admin') {
            $query->where('user_id', auth()->id());
        }

        // ✅ Date filter (admin + user dono ke liye)
        if ($fromDate && $toDate) {
            $query->whereBetween('created_at', [
                Carbon::parse($fromDate)->startOfDay(),
                Carbon::parse($toDate)->endOfDay()
            ]);
            $filter = 'custom';
        } else {
            if ($filter == 'today') {
                $query->whereDate('created_at', Carbon::today());
            } elseif ($filter == 'weekly') {
                $query->whereBetween('created_at', [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek()
                ]);
            } elseif ($filter == 'monthly') {
                $query->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year);
            } elseif ($filter == 'yearly') {
                $query->whereYear('created_at', Carbon::now()->year);
            }
        }

        // type wise count
        $counts = $query->select('type', DB::raw('COUNT(*) as total'))
            ->groupBy('type')
            ->pluck('total', 'type');

        $clickCount      = $counts['click'] ?? 0;
        $viewCount       = $counts['view'] ?? 0;
        $conversionCount = $counts['conversion'] ?? 0;

        return view('dashboard.dashboard', compact(
            'clickCount',
            'viewCount',
            'conversionCount',
            'filter',
            'fromDate',
            'toDate'
        ));
    }
}
