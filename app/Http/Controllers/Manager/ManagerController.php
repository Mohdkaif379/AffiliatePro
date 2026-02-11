<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function index()
    {
        $managers = User::whereHas('roleDetail', function ($query) {
            $query->where('name', 'Manager');
        })->get();

        return view('managers.index', compact('managers'));
    }
}
