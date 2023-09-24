<?php

namespace App\Http\Controllers;

use App\Enums\DeviceMode;
use App\Enums\FingerprintStatus;
use App\Enums\UserType;
use App\Http\Requests\StoreUserRequest;
use App\Models\Device;
use App\Models\Fingerprint;
use App\Models\User;
use Illuminate\Http\Request;

class DatabaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::query()->with(['fingerprint'])->get();
        $devices = Device::all();
        $userTypes = UserType::values();
        return view('admin.database.index', [
            'users' => $users,
            'userTypes' => $userTypes,
            'devices' => $devices
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        User::query()->create([
            'name' => $request->name,
            'matric_number' => $request->matric_number,
            'user_type' => $request->user_type,
            'department' => $request->department
        ]);
        toastr('success', 'You have successfully created a new user');
        return redirect(route('database.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $user_id)
    {
        $user = User::query()->with(['fingerprint'])->find($user_id);
        if ($user->fingerprint && $user->fingerprint->status == FingerprintStatus::Added)
        {
            toastr('warning', 'You have already added a fingerprint for this device');
            return redirect(route('database.index'));
        }
        $devices = Device::query()->where('mode', DeviceMode::Enrollment)->get();
        $lastAddedFingerprint = Fingerprint::query()
            ->where('status', FingerprintStatus::Added)
            ->latest('updated_at')
            ->first();
        $idToBeRegistered = $lastAddedFingerprint ? $lastAddedFingerprint->registered_id + 1 : 1;
        return view('admin.database.show', [
            'user' => $user,
            'devices' => $devices,
            'idToBeRegistered' => $idToBeRegistered
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $user_id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
