<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AccountantController extends Controller
{
    public function index()
    {
        $accountants = User::whereHas('roleDetail', function ($query) {
            $query->where('name', 'Accountant');
        })->get();

        return view('accountant.index', compact('accountants'));
    }
}
