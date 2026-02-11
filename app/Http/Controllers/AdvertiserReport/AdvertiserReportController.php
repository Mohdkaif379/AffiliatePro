<?php

namespace App\Http\Controllers\AdvertiserReport;

use App\Http\Controllers\Controller;
use App\Models\OfferClick;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdvertiserReportController extends Controller
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
                $q->where('name', 'Advertiser');
            });

        // Agar login user Advertiser hai → sirf apna data
        if ($user->roleDetail->name === 'Advertiser') {
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

        return view('advertiser_report.advertiser_report', compact('reports'));
    }
}
