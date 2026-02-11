<?php

namespace App\Http\Controllers\ManagerAssignedOffer;

use App\Http\Controllers\Controller;
use App\Models\AssignedOffer;
use Illuminate\Http\Request;

class ManagerAssignedOfferController extends Controller
{
    public function managerOffers()
    {
        $user = auth()->user();

        $query = AssignedOffer::with('offer', 'user');

        // Agar auth user ka role Advertiser hai
        if ($user->roleDetail->name === 'Manager') {
            // Sirf uske assigned offers fetch honge
            $query->where('user_id', $user->id);
        } else {
            // Agar Admin ya koi aur role hai, sab advertisers ke assigned offers fetch honge
            $query->whereHas('user.roleDetail', function ($q) {
                $q->where('name', 'Manager');
            });
        }

        $assignedOffers = $query->get();

        return view('manager_assigned_offer.manager_assigned_offer', compact('assignedOffers'));
    }
}
