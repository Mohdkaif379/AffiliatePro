<?php

namespace App\Http\Controllers\ManagerReport;

use App\Http\Controllers\Controller;
use App\Models\OfferClick;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagerReportController extends Controller
{
     public function getClickCount()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'User not authenticated']);
        }

        // Base query: sirf Advertiser role ke users ka data
        $query = OfferClick::with(['user', 'offer']) // offer relation bhi load
            ->whereHas('user.roleDetail', function ($q) {
                $q->where('name', 'Manager');
            });

        // Agar login user Advertiser hai → sirf apna data
        if ($user->roleDetail->name === 'Manager') {
            $query->where('user_id', $user->id);
        }

        // user + offer-wise + type-wise count
        $reports = $query->select(
            'user_id',
            'offer_id',
            'type',
            DB::raw('COUNT(*) as total')
        )
            ->groupBy('user_id', 'offer_id', 'type') // offer_id bhi group by
            ->get()
            ->groupBy(['user_id', 'offer_id']); // Blade me nested loop ke liye

        return view('manager_report.manager_report', compact('reports'));
    }
}
