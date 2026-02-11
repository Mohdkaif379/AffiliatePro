<?php

namespace App\Http\Controllers\Analytics;

use App\Http\Controllers\Controller;
use App\Models\OfferClick;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $userId  = $request->input('user_id');
        $offerId = $request->input('offer_id');

        // Base query
        $query = OfferClick::with(['user', 'offer'])
            ->whereHas('user', function ($q) {
                $q->whereHas('roleDetail', function ($roleQuery) {
                    $roleQuery->where('name', '!=', 'Admin'); // Admin exclude
                });
            });

        // Optional filters
        if ($userId) {
            $query->where('user_id', $userId);
        }

        if ($offerId) {
            $query->where('offer_id', $offerId);
        }

        $records = $query->orderBy('created_at')->get();

        // Group by date
        $grouped = $records->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });

        $labels = [];
        $clickValues = [];
        $viewValues = [];
        $conversionValues = [];

        foreach ($grouped as $date => $items) {
            $labels[] = $date;
            $clickValues[]      = $items->where('type', 'click')->count();
            $viewValues[]       = $items->where('type', 'view')->count();
            $conversionValues[] = $items->where('type', 'conversion')->count();
        }

        // Dropdown data (exclude Admins from users dropdown too)
        $users  = \App\Models\User::whereHas('roleDetail', function ($q) {
            $q->where('name', '!=', 'Admin');
        })->get();
        $offers = \App\Models\Offer::all();

        return view('analytics.analytics', compact(
            'labels',
            'clickValues',
            'viewValues',
            'conversionValues',
            'users',
            'offers',
            'userId',
            'offerId'
        ));
    }
}
