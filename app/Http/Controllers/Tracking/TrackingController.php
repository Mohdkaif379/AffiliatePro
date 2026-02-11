<?php

namespace App\Http\Controllers\Tracking;

use App\Http\Controllers\Controller;
use App\Models\OfferClick;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index()
    {
        $clicks = OfferClick::with('offer', 'user')->orderBy('created_at', 'desc')->get();
        return view('tracking.index', compact('clicks'));
    }
}
