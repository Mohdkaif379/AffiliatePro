<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = User::whereHas('roleDetail', function ($query) {
            $query->where('name', 'Employee');
        })->get();

        return view('employees.index', compact('employees'));
    }
}
