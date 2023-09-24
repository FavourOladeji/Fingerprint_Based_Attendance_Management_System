<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Http\Requests\StoreDeviceRequest;
use App\Http\Requests\UpdateDeviceRequest;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $devices = Device::all();
        return view('admin.devices.index', [
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
    public function store(StoreDeviceRequest $request)
    {
        Device::query()->create([
            'name' => $request->name,
            'location' => $request->location,
            'uid' => $request->uid
        ]);
        toastr('success', 'You have added a new device');
        return redirect(route('device.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Device $device)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Device $device)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeviceRequest $request, Device $device)
    {
        $device->update([
            'mode' => $request->mode
        ]);
        toastr('success', 'Device mode changed successfully');
        return redirect(route('device.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Device $device)
    {
        //
    }
}
