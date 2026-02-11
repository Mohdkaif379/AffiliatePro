<?php

namespace App\Http\Controllers\EmployeeAssignedOffer;

use App\Http\Controllers\Controller;
use App\Models\AssignedOffer;
use Illuminate\Http\Request;

class EmployeeAssignedOfferController extends Controller
{
    public function employeeOffer()
    {
        $user = auth()->user();

        $query = AssignedOffer::with('offer', 'user');

        // Agar auth user ka role Advertiser hai
        if ($user->roleDetail->name === 'Employee') {
            // Sirf uske assigned offers fetch honge
            $query->where('user_id', $user->id);
        } else {
            // Agar Admin ya koi aur role hai, sab advertisers ke assigned offers fetch honge
            $query->whereHas('user.roleDetail', function ($q) {
                $q->where('name', 'Employee');
            });
        }

        $assignedOffers = $query->get();

        return view('employee_assigned_offer.employee_assigned_offer', compact('assignedOffers'));
    }
}
