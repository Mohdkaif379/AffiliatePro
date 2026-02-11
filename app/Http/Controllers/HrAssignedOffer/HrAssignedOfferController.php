<?php

namespace App\Http\Controllers\HrAssignedOffer;

use App\Http\Controllers\Controller;
use App\Models\AssignedOffer;
use Illuminate\Http\Request;

class HrAssignedOfferController extends Controller
{
     public function hrOffers()
    {
        $user = auth()->user();

        $query = AssignedOffer::with('offer', 'user');

        // Agar auth user ka role Advertiser hai
        if ($user->roleDetail->name === 'Hr') {
            // Sirf uske assigned offers fetch honge
            $query->where('user_id', $user->id);
        } else {
            // Agar Admin ya koi aur role hai, sab advertisers ke assigned offers fetch honge
            $query->whereHas('user.roleDetail', function ($q) {
                $q->where('name', 'Hr');
            });
        }

        $assignedOffers = $query->get();

        return view('hr_assigned_offer.hr_assigned_offer', compact('assignedOffers'));
    }
}
