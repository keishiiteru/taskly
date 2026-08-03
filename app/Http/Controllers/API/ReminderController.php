<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReminderRequest;
use App\Http\Requests\UpdateReminderRequest;
use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReminderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReminderRequest $request)
    {
        Reminder::create([
            ...$request->validated(),
            'user_id' => Auth::id()
        ]);

         return response()->json([
            'message' => 'Reminder Created Successfully!'
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReminderRequest $request, string $id)
    {
        $validated = $request->validated();

        $reminder = Reminder::findOrFail($id);

        $reminder->update($validated);

        return response()->json([
            'message' => 'Reminder Updated Successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reminder = Reminder::findOrFail($id);

        $reminder->delete();

        return response()->json([
            'message' => 'Reminder Deleted Successfully!'
        ]);
    }
}
