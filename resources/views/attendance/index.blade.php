@extends('layout.app')

@section('content')
<div class="mx-auto mt-6 max-w-7xl rounded-3xl bg-slate-50 p-4 md:p-6">

    <div class="mb-6 flex items-center gap-3 border-b border-slate-200 pb-4">
        <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-900 text-white shadow-sm">
            <i class="fas fa-calendar-check"></i>
        </span>
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Attendance</h1>
            <p class="mt-1 text-sm text-slate-500">Mark in/out and review attendance history.</p>
        </div>
    </div>

    <!-- Success / Error Messages -->
    @if(session('success'))
    <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 p-3 text-emerald-700 shadow-sm">
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="mb-4 rounded-xl border border-rose-200 bg-rose-50 p-3 text-rose-700 shadow-sm">
        {{ session('error') }}
    </div>
    @endif

    <!-- Single Mark In / Mark Out Buttons -->
    <div class="mb-6 flex items-center gap-4">

        @php
        $todayAttendance = $attendances->where('today_date', \Carbon\Carbon::today('Asia/Kolkata')->toDateString())
        ->where('user_id', auth()->id())
        ->first();
        @endphp

        {{-- Mark In Button --}}
        <a href="{{ $todayAttendance ? '#' : route('attendance.markin') }}">
            <button
                class="rounded-xl bg-slate-900 px-6 py-2 font-semibold text-white shadow-sm transition hover:bg-slate-800 disabled:cursor-not-allowed disabled:opacity-50"
                @if($todayAttendance) disabled @endif>
                <i class="fa-solid fa-sign-in-alt mr-1"></i> Mark In
            </button>
        </a>

        {{-- Mark Out Button --}}
        <a href="{{ $todayAttendance && !$todayAttendance->mark_out_time ? route('attendance.markout', $todayAttendance->id) : '#' }}">
            <button
                class="rounded-xl bg-white px-6 py-2 font-semibold text-slate-700 shadow-sm ring-1 ring-slate-200 transition hover:bg-slate-50 disabled:cursor-not-allowed disabled:opacity-50"
                @if(!$todayAttendance || $todayAttendance->mark_out_time) disabled @endif>
                <i class="fa-solid fa-clock mr-1"></i> Mark Out
            </button>
        </a>

    </div>

    <!-- Attendance Table -->
    <div class="overflow-x-auto rounded-3xl border border-slate-200 bg-white shadow-sm">
        <div class="max-h-[500px] overflow-y-auto">
            <table class="min-w-full text-sm text-slate-700">
                <thead class="sticky top-0 z-10 bg-slate-50">
                    <tr class="text-xs uppercase tracking-wider text-slate-500">
                        <th class="px-4 py-3 border-b border-slate-200">ID</th>
                        <th class="px-4 py-3 border-b border-slate-200">Employee Name</th>
                        <th class="px-4 py-3 border-b border-slate-200">Mark In</th>
                        <th class="px-4 py-3 border-b border-slate-200">Mark Out</th>
                        <th class="px-4 py-3 border-b border-slate-200">Date</th>
                        <th class="px-4 py-3 border-b border-slate-200">Status</th>
                        <th class="px-4 py-3 border-b border-slate-200">Early Leaving</th>
                        <th class="px-4 py-3 border-b border-slate-200">Overtime</th>
                        <th class="px-4 py-3 border-b border-slate-200">Working Hours</th>
                        <th class="px-4 py-3 border-b border-slate-200 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($attendances as $att)
                    <tr class="transition hover:bg-slate-50">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-slate-900">{{ $att->user->full_name }}</td>

                        <td class="px-4 py-3">
                            {{ $att->mark_in_time ? \Carbon\Carbon::parse($att->mark_in_time)->format('h:i A') : '-' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $att->mark_out_time ? \Carbon\Carbon::parse($att->mark_out_time)->format('h:i A') : 'Not Marked' }}
                        </td>

                        <td class="px-4 py-3">{{ $att->today_date }}</td>

                        <td class="px-4 py-3">
                            @if($att->status == 'Present')
                            <span class="inline-flex rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                                {{ $att->status }}
                            </span>
                            @elseif($att->status == 'Halfday')
                            <span class="inline-flex rounded-full border border-amber-200 bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">
                                {{ $att->status }}
                            </span>
                            @elseif($att->status == 'Absent')
                            <span class="inline-flex rounded-full border border-slate-200 bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                                {{ $att->status }}
                            </span>
                            @elseif($att->status == 'Leave')
                            <span class="inline-flex rounded-full border border-rose-200 bg-rose-50 px-3 py-1 text-xs font-semibold text-rose-700">
                                {{ $att->status }}
                            </span>
                            @elseif($att->status == 'Holiday')
                            <span class="inline-flex rounded-full border border-blue-200 bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                                {{ $att->status }}
                            </span>
                            @endif
                        </td>

                        {{-- Early Leaving --}}
                        <td class="px-4 py-3">
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
                            <span class="inline-flex rounded-full border border-amber-200 bg-amber-50 px-2 py-1 text-xs font-semibold text-amber-700">
                                Early by {{ $h }}h {{ $m }}m
                            </span>
                            @else
                            <span class="text-xs font-semibold text-emerald-600">
                                On Time
                            </span>
                            @endif
                            @else
                            <span class="text-xs text-slate-400">Not Marked Out</span>
                            @endif
                        </td>

                        {{-- Overtime --}}
                        <td class="px-4 py-3">
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
                            <span class="inline-flex items-center gap-1 rounded-full border border-emerald-200 bg-emerald-50 px-2 py-1 text-xs font-semibold text-emerald-700">
                                <i class="fa-solid fa-clock-rotate-left"></i>
                                Overtime {{ $oh }}h {{ $om }}m
                            </span>
                            @else
                            <span class="text-xs text-slate-400">N/A</span>
                            @endif
                            @else
                            <span class="text-xs text-slate-400">Not Marked Out</span>
                            @endif
                        </td>

                        {{-- Working Hours --}}
                        <td class="px-4 py-3">
                            @if($att->mark_in_time && $att->mark_out_time)
                            @php
                            $markIn = \Carbon\Carbon::parse($att->mark_in_time);
                            $markOut = \Carbon\Carbon::parse($att->mark_out_time);

                            $totalMinutes = $markIn->diffInMinutes($markOut);
                            $wh = intdiv($totalMinutes, 60);
                            $wm = $totalMinutes % 60;
                            @endphp

                            <span class="inline-flex rounded-full border border-slate-200 bg-slate-100 px-2 py-1 text-xs font-semibold text-slate-700">
                                {{ $wh }}h {{ $wm }}m
                            </span>
                            @else
                            <span class="text-xs text-slate-400">Not Completed</span>
                            @endif
                        </td>

                        {{-- Actions --}}
                        <td class="px-4 py-3 text-center">
                            <form action="{{ route('attendance.destroy', $att->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Delete this attendance?')"
                                    class="rounded-xl bg-rose-600 px-3 py-1 text-white shadow-sm transition hover:bg-rose-500">
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
