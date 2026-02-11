<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\OfferClick;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
  

public function getAllReports()
{
    $user = auth()->user();

    if (!$user) {
        return redirect()->back()->withErrors(['error' => 'User not authenticated']);
    }

    // Base query: OfferClick ke saath user + offer relation load
    $query = OfferClick::with(['user', 'offer']);

    // user + offer + type-wise count
    $reports = $query->select(
            'user_id',
            'offer_id',
            'type',
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('user_id', 'offer_id', 'type')
        ->get()
        ->groupBy(['user_id', 'offer_id']); // Blade me nested loop

    return view('reports.all_reports', compact('reports'));
}

}
