<?php

namespace App\Http\Controllers\Attendence;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendenceController extends Controller
{
    // Attendance list
    public function index()
    {
        if (!session()->has('email')) {
            return redirect()->route('login');
        }

        $query = Attendance::with('user')->orderBy('today_date', 'desc');

        // ✅ Role check (same as dashboard)
        $roleName = strtolower(auth()->user()->roleDetail->name);

        // ✅ Sirf non-admin ke liye user_id filter
        if ($roleName !== 'admin') {
            $query->where('user_id', auth()->id());
        }

        $attendances = $query->get();

        return view('attendance.index', compact('attendances'));
    }



    // Mark in attendance (single button)
    public function markIn()
    {
        $user = Auth::user();
        $today = Carbon::today('Asia/Kolkata')->toDateString();
        $now = Carbon::now('Asia/Kolkata');

        // Check if already marked
        $existing = Attendance::where('user_id', $user->id)
            ->where('today_date', $today)
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Attendance already marked today');
        }

        // Time limits
        $presentTime = Carbon::createFromTime(9, 30, 0, 'Asia/Kolkata');   // 09:30 AM
        $lastTime    = Carbon::createFromTime(18, 30, 0, 'Asia/Kolkata');  // 06:30 PM

        // Decide status
        if ($now->lte($presentTime)) {
            $status = 'Present';
        } elseif ($now->gt($presentTime) && $now->lte($lastTime)) {
            $status = 'Halfday';
        } else {
            return redirect()->back()->with('error', 'Attendance time is over (after 6:30 PM)');
        }

        Attendance::create([
            'user_id' => $user->id,
            'mark_in_time' => $now,
            'today_date' => $today,
            'status' => $status, // ENUM value
        ]);

        return redirect()->back()->with('success', "Attendance marked as $status");
    }


    // Mark out (optional)
    public function markOut($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->update([
            'mark_out_time' => Carbon::now('Asia/Kolkata'),
        ]);

        return redirect()->back()->with('success', 'Attendance marked out successfully');
    }

    // Delete attendance
    public function destroy($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();

        return redirect()->back()->with('success', 'Attendance deleted successfully');
    }

  
}
