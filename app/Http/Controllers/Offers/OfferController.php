<?php

namespace App\Http\Controllers\Offers;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Language;
use App\Models\Offer;
use App\Models\Role;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class OfferController extends Controller
{
    private function getRealIp(Request $request)
    {
        // Check for forwarded IP headers first
        $headers = ['X-Forwarded-For', 'X-Real-IP', 'CF-Connecting-IP', 'X-Cluster-Client-IP'];
        foreach ($headers as $header) {
            if ($request->hasHeader($header)) {
                $ip = $request->header($header);
                // Take the first IP if multiple are present
                $ip = explode(',', $ip)[0];
                $ip = trim($ip);
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                    return $ip;
                }
            }
        }

        // Fallback to Laravel's ip() method, allow localhost for testing
        $ip = $request->ip();
        if (filter_var($ip, FILTER_VALIDATE_IP)) {
            return $ip;
        }

        return null; // No valid IP found
    }
    public function index(Request $request)
    {
        $offers = Offer::with('advertiser', 'assignedUsers') // eager load to avoid N+1
            ->orderBy('created_at', 'desc')
            ->get();

        // Track view if user_id is provided (someone accessed via shared link)
        $userId = $request->query('user_id');
        $realIp = $this->getRealIp($request);
        if ($userId && $realIp) {
            // Check if view from this IP for this user already exists (no specific offer)
            $existingView = \App\Models\OfferClick::where('offer_id', null)
                ->where('user_id', $userId)
                ->where('ip_address', $realIp)
                ->where('type', 'view')
                ->exists();

            if (!$existingView) {
                \App\Models\OfferClick::create([
                    'offer_id' => null, // No specific offer, just page view
                    'user_id' => $userId,
                    'ip_address' => $realIp,
                    'user_agent' => $request->userAgent(),
                    'type' => 'view',
                ]);
            }
        }

        return view('offers.index', compact('offers'));
    }

    public function create()
    {
        // 1️⃣ Other dropdowns
        $cities     = City::orderBy('name')->get();
        $countries  = Country::orderBy('country_name')->get();
        $states     = State::orderBy('name')->get();
        $languages  = Language::orderBy('name')->get();

        // 2️⃣ Advertiser role ID
        $advertiserRole = Role::where('name', 'advertiser')->first();
        $advertiserRoleId = $advertiserRole ? $advertiserRole->id : null;


        $advertisers = User::where('role', $advertiserRoleId)->get();

        return view(
            'offers.create',
            compact('cities', 'countries', 'states', 'languages', 'advertisers')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'offer_title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'offer_category' => 'nullable|string|max:255',
            'offer_url' => 'nullable|url',
            'advertiser_id' => 'nullable|exists:users,id',
            'advertiser_price' => 'nullable|numeric|min:0',
            'affiliate_price' => 'nullable|numeric|min:0',
            'schedule' => 'nullable|date',
            'device_brand' => 'nullable|string|max:255',
            'os_version' => 'nullable|string|max:255',
            'operating_system' => 'nullable|in:Android,iOS,Windows',
            'device' => 'nullable|in:Mobile,Desktop,Tablet',
            'country_id' => 'nullable|exists:countries,id',
            'state_id' => 'nullable|exists:states,id',
            'city_id' => 'nullable|exists:cities,id',
            'language_id' => 'nullable|exists:languages,id',
            'browser' => 'nullable|string|max:255',
            'upload_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx|max:2048',
            'terms_conditions' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->all();

        // Map IDs to names
        $data['advertiser_name'] = $data['advertiser_id'] ?? null;
        unset($data['advertiser_id']);

        if ($data['country_id']) {
            $country = Country::find($data['country_id']);
            $data['country'] = $country ? $country->country_name : null;
        }
        unset($data['country_id']);

        if ($data['state_id']) {
            $state = State::find($data['state_id']);
            $data['state'] = $state ? $state->name : null;
        }
        unset($data['state_id']);

        if ($data['city_id']) {
            $city = City::find($data['city_id']);
            $data['city'] = $city ? $city->name : null;
        }
        unset($data['city_id']);

        if ($data['language_id']) {
            $language = Language::find($data['language_id']);
            $data['user_language'] = $language ? $language->name : null;
        }
        unset($data['language_id']);

        // File upload
        if ($request->hasFile('upload_file')) {
            $file = $request->file('upload_file');
            $path = $file->store('uploads', 'public'); // storage/app/public/uploads
            $data['upload_file'] = Storage::url($path); // public URL for browser
        }

        // Generate unique random URL
        do {
            $randomUrl = Str::random(10);
        } while (Offer::where('random_url', $randomUrl)->exists());

        $data['random_url'] = $randomUrl;

        Offer::create($data);
        return redirect()->route('offers.index')->with('success', 'Offer created successfully.');
    }


    public function destroy($id)
    {
        // Find the offer by ID
        $offer = Offer::findOrFail($id);


        if ($offer->upload_file && Storage::exists('public/uploads/' . $offer->upload_file)) {
            Storage::delete('public/uploads/' . $offer->upload_file);
        }

        // Delete the offer
        $offer->delete();

        // Redirect back with success message
        return redirect()->route('offers.index')->with('success', 'Offer deleted successfully.');
    }

    public function show($randomUrl, Request $request)
    {
        $offer = Offer::where('random_url', $randomUrl)->firstOrFail();

        // Track view for all accesses with valid IP
        $userId = $request->query('user_id'); // May be null for direct accesses
        $realIp = $this->getRealIp($request);
        if ($realIp) {
            // Check if view from this IP for this offer and user already exists (user_id can be null)
            $existingView = \App\Models\OfferClick::where('offer_id', $offer->id)
                ->where('user_id', $userId)
                ->where('ip_address', $realIp)
                ->where('type', 'view')
                ->exists();

            if (!$existingView) {
                // Track view when someone visits the offer page
                \App\Models\OfferClick::create([
                    'offer_id' => $offer->id,
                    'user_id' => $userId, // Null for direct accesses
                    'ip_address' => $realIp,
                    'user_agent' => $request->userAgent(),
                    'type' => 'view',
                ]);
            }
        }

        return view('offers.show', compact('offer'));
    }

    public function redirect($randomUrl, Request $request)
    {
        $offer = Offer::where('random_url', $randomUrl)->firstOrFail();

        // Check if user_id is provided in the URL (for shared URLs)
        $userId = $request->query('user_id');
        $realIp = $this->getRealIp($request);
        if ($userId && $realIp) {
            // Check if view from this IP for this user and offer already exists
            $existingView = \App\Models\OfferClick::where('offer_id', $offer->id)
                ->where('user_id', $userId)
                ->where('ip_address', $realIp)
                ->where('type', 'view')
                ->exists();

            if (!$existingView) {
                // Track view when someone is redirected to the external URL
                \App\Models\OfferClick::create([
                    'offer_id' => $offer->id,
                    'user_id' => $userId,
                    'ip_address' => $realIp,
                    'user_agent' => $request->userAgent(),
                    'type' => 'view',
                ]);
            }
        }

        return redirect()->away($offer->offer_url);
    }

    public function click($randomUrl, Request $request)
    {
        $offer = Offer::where('random_url', $randomUrl)->firstOrFail();

        // Check if user_id is provided in the URL (for shared URLs)
        $userId = $request->query('user_id');
        if ($userId) {
            // Check if click from this IP for this user and offer already exists
            $existingClick = \App\Models\OfferClick::where('offer_id', $offer->id)
                ->where('user_id', $userId)
                ->where('ip_address', $request->ip())
                ->where('type', 'click')
                ->exists();

            if (!$existingClick) {
                // Track click when they actually click to go to external URL
                \App\Models\OfferClick::create([
                    'offer_id' => $offer->id,
                    'user_id' => $userId,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'type' => 'click',
                ]);
            }
        }

        return redirect()->away($offer->offer_url);
    }
}
