<?php

namespace App\Http\Controllers\AdvertiserAssignedOffer;

use App\Http\Controllers\Controller;
use App\Models\AssignedOffer;
use Illuminate\Http\Request;

class AdvertiserAssignedOfferController extends Controller
{
    public function advertiserOffers()
    {
        $user = auth()->user();

        $query = AssignedOffer::with('offer', 'user');

        // Agar auth user ka role Advertiser hai
        if ($user->roleDetail->name === 'Advertiser') {
            // Sirf uske assigned offers fetch honge
            $query->where('user_id', $user->id);
        } else {
            // Agar Admin ya koi aur role hai, sab advertisers ke assigned offers fetch honge
            $query->whereHas('user.roleDetail', function ($q) {
                $q->where('name', 'Advertiser');
            });
        }

        $assignedOffers = $query->get();

        return view('advertiser_assigned_offer.advertiser_assigned_offer', compact('assignedOffers'));
    }
}
