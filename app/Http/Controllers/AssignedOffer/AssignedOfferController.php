<?php

namespace App\Http\Controllers\AssignedOffer;

use App\Http\Controllers\Controller;
use App\Models\AssignedOffer;
use Illuminate\Http\Request;

class AssignedOfferController extends Controller
{
    public function index()
    {
        $assignedOffers = AssignedOffer::with('offer', 'user')
            ->where('created_at', '>=', now()->subHours(12))
            ->orderBy('created_at', 'desc')
            ->get();

        return view('assigned_offers.index', compact('assignedOffers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'offer_id' => 'required|exists:offers,id',
            'user_id' => 'required|array',
            'user_id.*' => 'exists:users,id',
        ]);

        $offerId = $request->offer_id;
        $userIds = $request->user_id;

        foreach ($userIds as $userId) {
            AssignedOffer::create([
                'offer_id' => $offerId,
                'user_id' => $userId,
            ]);
        }

        return redirect()->route('offers.index')->with('success', 'Offer assigned successfully.');
    }
}
