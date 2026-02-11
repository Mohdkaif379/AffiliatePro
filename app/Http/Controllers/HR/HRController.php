<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class HRController extends Controller
{
    public function index()
    {
        $hrs = User::whereHas('roleDetail', function ($query) {
            $query->where('name', 'Hr');
        })->get();

        return view('hr.index', compact('hrs'));
    }
}
