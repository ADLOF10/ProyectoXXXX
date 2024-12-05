<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function registerAttendance(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'qr_code_data' => 'required|string',
        ]);

        // Se guarda la asistencia en la BD
        $attendance = new Attendance();
        $attendance->user_id = $request->user_id;
        $attendance->qr_code_data = $request->qr_code_data;
        $attendance->save();

        return redirect()->route('attendance.success');
    }
}