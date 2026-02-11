@extends('layout.app')

@section('content')
<div class="max-w-7xl mx-auto mt-10 p-6">

    <h1 class="text-3xl font-bold mb-6 text-yellow-400 flex items-center gap-2">
        <i class="fas fa-calendar-check"></i> Attendance
    </h1>

    <!-- Success / Error Messages -->
    @if(session('success'))
    <div class="mb-4 p-3 bg-green-300 text-white rounded shadow">
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="mb-4 p-3 bg-red-500 text-white rounded shadow">
        {{ session('error') }}
    </div>
    @endif

    <!-- Single Mark In / Mark Out Buttons -->
    <div class="mb-6 flex gap-4 items-center">

        @php
        $todayAttendance = $attendances->where('today_date', \Carbon\Carbon::today('Asia/Kolkata')->toDateString())
        ->where('user_id', auth()->id())
        ->first();
        @endphp

        {{-- Mark In Button --}}
        <a href="{{ $todayAttendance ? '#' : route('attendance.markin') }}">
            <button
                class="px-6 py-2 bg-yellow-500 text-gray-900 font-semibold rounded-lg transition shadow disabled:opacity-50 disabled:cursor-not-allowed hover:bg-yellow-500"
                @if($todayAttendance) disabled @endif>
                <i class="fa-solid fa-sign-in-alt mr-1"></i> Mark In
            </button>
        </a>

        {{-- Mark Out Button --}}
        <a href="{{ $todayAttendance && !$todayAttendance->mark_out_time ? route('attendance.markout', $todayAttendance->id) : '#' }}">
            <button
                class="px-6 py-2 bg-yellow-500 text-gray-900 font-semibold rounded-lg transition shadow disabled:opacity-50 disabled:cursor-not-allowed hover:bg-yellow-500"
                @if(!$todayAttendance || $todayAttendance->mark_out_time) disabled @endif
                >
                <i class="fa-solid fa-clock mr-1"></i> Mark Out
            </button>
        </a>

    </div>


    <!-- Attendance Table -->
    <div class="overflow-x-auto border border-yellow-600 rounded-lg shadow-lg">
        <div class="max-h-[500px] overflow-y-auto">
            <table class="min-w-full bg-gray-900 text-sm">
                <thead class="sticky top-0 bg-gray-800 z-10">
                    <tr class="text-yellow-400 uppercase text-xs tracking-wider">
                        <th class="px-4 py-3 border-b">ID</th>
                        <th class="px-4 py-3 border-b">Employee Name</th>
                        <th class="px-4 py-3 border-b">Mark In</th>
                        <th class="px-4 py-3 border-b">Mark Out</th>
                        <th class="px-4 py-3 border-b">Date</th>
                        <th class="px-4 py-3 border-b">Status</th>
                        <th class="px-4 py-3 border-b">Early Leaving</th>
                        <th class="px-4 py-3 border-b">Overtime</th>
                        <th class="px-4 py-3 border-b">Working Hours</th>
                        <th class="px-4 py-3 border-b text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendances as $att)
                    <tr class="hover:bg-gray-800 transition text-white">
             <td class="px-4 py-2 border-b">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 border-b">{{ $att->user->full_name }}</td>

                        <td class="px-4 py-2 border-b">
                            {{ $att->mark_in_time ? \Carbon\Carbon::parse($att->mark_in_time)->format('h:i A') : '-' }}
                        </td>

                        <td class="px-4 py-2 border-b">
                            {{ $att->mark_out_time ? \Carbon\Carbon::parse($att->mark_out_time)->format('h:i A') : 'Not Marked' }}
                        </td>

                        <td class="px-4 py-2 border-b">{{ $att->today_date }}</td>

                        <td class="px-4 py-2 border-b">
                            @if($att->status == 'Present')
                            <span class="px-3 py-1 rounded-full bg-yellow-200 text-yellow-900 text-xs font-semibold">
                                {{ $att->status }}
                            </span>
                            @elseif($att->status == 'Halfday')
                            <span class="px-3 py-1 rounded-full bg-yellow-400 text-gray-900 text-xs font-semibold">
                                {{ $att->status }}
                            </span>
                            @elseif($att->status == 'Absent')
                            <span class="px-3 py-1 rounded-full bg-gray-300 text-gray-800 text-xs font-semibold">
                                {{ $att->status }}
                            </span>
                            @elseif($att->status == 'Leave')
                            <span class="px-3 py-1 rounded-full bg-red-200 text-red-800 text-xs font-semibold">
                                {{ $att->status }}
                            </span>
                            @elseif($att->status == 'Holiday')
                            <span class="px-3 py-1 rounded-full bg-blue-200 text-blue-800 text-xs font-semibold">
                                {{ $att->status }}
                            </span>
                            @endif
                        </td>

                        {{-- Early Leaving --}}
                        <td class="px-4 py-2 border-b">
                            @if($att->mark_out_time)
                            @php
                            $markOut = \Carbon\Carbon::parse($att->mark_out_time);
                            $officeEnd = \Carbon\Carbon::parse($att->today_date.' 18:30:00');

                            if($markOut->lt($officeEnd)){
                            $earlyMinutes = $markOut->diffInMinutes($officeEnd);
                            $h = intdiv($earlyMinutes, 60);
                            $m = $earlyMinutes % 60;
                            }
                            @endphp

                            @if(isset($earlyMinutes) && $earlyMinutes > 0)
                            <span class="px-2 py-1 rounded bg-gray-800 text-yellow-400 text-xs">
                                Early by {{ $h }}h {{ $m }}m
                            </span>
                            @else
                            <span class="text-green-500 font-semibold text-xs">
                                On Time
                            </span>
                            @endif
                            @else
                            <span class="text-gray-400 text-xs">Not Marked Out</span>
                            @endif
                        </td>

                        {{-- Overtime --}}
                        <td class="px-4 py-2 border-b">
                            @if($att->mark_out_time)
                            @php
                            $markOut = \Carbon\Carbon::parse($att->mark_out_time);
                            $officeEnd = \Carbon\Carbon::parse($att->today_date.' 18:30:00');

                            if($markOut->gt($officeEnd)){
                            $overtimeMinutes = $officeEnd->diffInMinutes($markOut);
                            $oh = intdiv($overtimeMinutes, 60);
                            $om = $overtimeMinutes % 60;
                            }
                            @endphp

                            @if(isset($overtimeMinutes) && $overtimeMinutes > 0)
                            <span class="flex items-center gap-1 text-green-500 font-semibold text-xs">
                                <i class="fa-solid fa-clock-rotate-left"></i>
                                Overtime {{ $oh }}h {{ $om }}m
                            </span>
                            @else
                            <span class="text-gray-400 text-xs">N/A</span>
                            @endif
                            @else
                            <span class="text-gray-400 text-xs">Not Marked Out</span>
                            @endif
                        </td>

                        {{-- Working Hours --}}
                        <td class="px-4 py-2 border-b">
                            @if($att->mark_in_time && $att->mark_out_time)
                            @php
                            $markIn = \Carbon\Carbon::parse($att->mark_in_time);
                            $markOut = \Carbon\Carbon::parse($att->mark_out_time);

                            $totalMinutes = $markIn->diffInMinutes($markOut);
                            $wh = intdiv($totalMinutes, 60);
                            $wm = $totalMinutes % 60;
                            @endphp

                            <span class="px-2 py-1 rounded bg-gray-800 text-yellow-400 text-xs font-semibold">
                                {{ $wh }}h {{ $wm }}m
                            </span>
                            @else
                            <span class="text-gray-400 text-xs">Not Completed</span>
                            @endif
                        </td>

                        {{-- Actions --}}
                        <td class="px-4 py-2 border-b text-center">
                            <form action="{{ route('attendance.destroy', $att->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Delete this attendance?')"
                                    class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition shadow">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection