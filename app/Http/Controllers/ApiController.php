<?php

namespace App\Http\Controllers;

use App\Enums\AttendanceStatus;
use App\Enums\DeviceMode;
use App\Enums\FingerprintStatus;
use App\Models\Attendance;
use App\Models\Device;
use App\Models\Fingerprint;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function checkMode(Request $request)
    {
//        The microcontroller checks the mode of the fingerprint device every 25 seconds
//         Check the mode of the device
        $deviceToken = $request->device_token;
        $device = Device::query()->where('uid', $deviceToken)->first();
        if ($device->mode == DeviceMode::Attendance) {
            $mode = 1;
        }
        if ($device->mode == DeviceMode::Enrollment) {
            $mode = 0;
        }
        echo "mode" . $mode;
        exit();

    }

    public function storeAttendance(Request $request)
    {
        $fingerprintID = $request->FingerID;
        $hours = Schedule::getHours();
        $user = User::query()->with('attendances')
            ->whereHas('fingerprint', function ($query) use ($fingerprintID) {
                $query->where('registered_id', $fingerprintID);
            })
            ->first();
        //Check in or check out the user
        $currentDay = now()->format('l');
        $startingTime = now()->startOfHour()->format('H:i:s');

        // Find if a schedule is at the current time of storing attendance
        $currentSchedule = Schedule::query()
            ->where('day', $currentDay)
            ->where('time', $startingTime)
            ->first();


//        if ($currentSchedule) {
//            $lastAttendance = Attendance::query()
//                ->whereHas('user', function ($query) use ($user) {
//                    $query->where('id', $user->id);
//                })
//                ->whereHas('schedule', function ($query) use ($currentSchedule) {
//                    $query->where('id', $currentSchedule->id);
//                })
//                ->whereDate('created_at', now())
//                ->latest()
//                ->first();
//
//            if ($lastAttendance && !$lastAttendance->has_checked_out)
//            {
//                $lastAttendance->update([
//                    'timeout' => now(),
//                    'has_checked_out' => true
//                ]);
//                return "logout" . $user->name;
//            }
//        }

        $lastAttendance = $user->attendances()->where('schedule_id', $currentSchedule?->id ?? null)
            ->whereDate('created_at', now())
            ->latest()
            ->first();
        //user has checked in to that class previously today, "CHECK THE OUT"
        if (!$lastAttendance || $lastAttendance?->has_checked_out) {
            Attendance::query()->create([
                'user_id' => $user->id,
                'schedule_id' => $currentSchedule?->id ?? null,
                'status' => now() > Carbon::parse($startingTime)->addMinutes(15) ? AttendanceStatus::Present : AttendanceStatus::Late,
            ]);
            return "login" . $user->name . 'Checked in to new schedule';
        }

        $lastAttendance->update([
            'timeout' => now(),
            'has_checked_out' => true
        ]);
        return "logout" . $user->name;
    }

    public function confirmAddingId(Request $request)
    {
        $deviceToken = $request->device_token;
        $fingerprintIDtoBeAdded = $request->confirm_id;
        $fingerprint = Fingerprint::query()
            ->where('status', FingerprintStatus::Pending)
            ->where('id_to_be_registered', $fingerprintIDtoBeAdded)
            ->latest()
            ->first();

        //Change the status to added and change Id_to_be_registered to null
        if (!$fingerprint->update([
            'status' => FingerprintStatus::Added,
            'registered_id' => $fingerprintIDtoBeAdded,
            'id_to_be_registered' => null,
        ])) {
            echo "Unable to add fingerprint";
            abort(400);
        }
        echo "Fingerprint has been added";

    }

    public function checkToAddId(Request $request)
    {
        //The microcontroller sends a request every 10 seconds when the device is set to enrollment mode
        //to check whether there is an ID that needs to be added
        $pendingFingerprint = Fingerprint::query()
            ->where('status', FingerprintStatus::Pending)
            ->whereNotNull('id_to_be_registered')
            ->latest()
            ->first();
        if (!$pendingFingerprint) {
            echo "Nothing";
            exit();
        }
        if ($pendingFingerprint->updated_at->addMinutes(2) >= now()) {
            $pendingFingerprintID = $pendingFingerprint->id_to_be_registered;
            echo "add-id" . $pendingFingerprintID;
            exit();
        }
        echo "Nothing";
        exit();
    }

    public function checkToDelete()
    {
        //The microcontroller sends a request every 10 seconds when the device is set to enrollment mode
        //to check whether there is an ID that needs to be deleted

    }

    public function enroll(Request $request)
    {

        $deviceID = Device::query()->where('uid', $request->device_uid)->first()->id;
        $fingerprint = Fingerprint::query()
            ->where('user_id', $request->user_id)
            ->where('device_id', $deviceID)
            ->first();

        //If there is no fingerprint
        if ($fingerprint && $fingerprint->status == FingerprintStatus::Added) {
            return response()->json([
                'message' => 'You have already added a fingerprint for this user on the selected device',
                'success' => false
            ], 400);
        }
        if ($fingerprint && $fingerprint->status == FingerprintStatus::Pending) {
            $updated = $fingerprint->update([
                'id_to_be_registered' => $request->id_to_be_registered,
                'status' => FingerprintStatus::Pending,
            ]);
            $fingerprint->touch();
            if ($updated) {
                return response()->json([
                    'message' => 'Place your finger on the fingerprint device',
                    'fingerprint_id' => $fingerprint->id,
                    'success' => true,
                    'mode' => 'updated'
                ]);
            }
        }
        if (!$fingerprint) {
            $fingerprint = Fingerprint::query()->create([
                'user_id' => $request->user_id,
                'id_to_be_registered' => $request->id_to_be_registered,
                'device_id' => $deviceID,
                'status' => FingerprintStatus::Pending
            ]);
        }

        if (!$fingerprint) {
            return response()->json([
                'message' => 'Unable to add fingerprint for enrollment ',
                'success' => false
            ], 400);
        }

        return response()->json([
            'message' => 'Place your finger on the fingerprint device',
            'fingerprint_id' => $fingerprint->id,
            'success' => true
        ]);
    }

    public function verify(Request $request)
    {
        $fingerprint = Fingerprint::query()->find($request->fingerprint_id);
        if ($fingerprint->status == FingerprintStatus::Pending) {
            return response()->json([
                'message' => "Place your finger on the fingerprint device",
                'success' => false
            ]);
        }

        if ($fingerprint->status == FingerprintStatus::Added) {
            return response()->json([
                'message' => "Fingerprint has been added successfully",
                'success' => true
            ]);
        }
    }

    public function deleteFingerprint(Request $request)
    {

    }
}
