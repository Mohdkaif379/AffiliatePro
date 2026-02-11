<?php

namespace App\Http\Controllers\Advertiser;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdvertiserController extends Controller
{
    public function index()
    {
        $advertisers = User::whereHas('roleDetail', function ($query) {
            $query->where('name', 'Advertiser');
        })->get();

        return view('advertisers.index', compact('advertisers'));
    }
}
