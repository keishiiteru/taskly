<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRecurrenceRequest;
use App\Models\Task;
use App\Models\TaskRecurrence;
use Illuminate\Http\Request;

class TaskRecurrenceController extends Controller
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
    public function store(StoreTaskRecurrenceRequest $request, Task $task)
    {

        if ($task->recurrence) {
            return response()->json([
                'message' => 'Task already has a recurrence. Use PUT to update it instead.',
            ], 409);
        }

        $recurrence = TaskRecurrence::create(
            $request->validated() + ['task_id' => $task->id]
        );

        return response()->json($recurrence, 201);
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
