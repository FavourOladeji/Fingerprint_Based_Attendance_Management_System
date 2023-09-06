<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class DatabaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $userTypes = UserType::values();
        return view('admin.database.index', [
            'users' => $users,
            'userTypes' => $userTypes
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
