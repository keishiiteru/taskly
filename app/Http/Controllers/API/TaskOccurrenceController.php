<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskOccurenceRequest;
use App\Models\Task;
use App\Models\TaskOccurrence;
use Illuminate\Http\Request;

class TaskOccurrenceController extends Controller
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
    public function store(StoreTaskOccurenceRequest $request, Task $task)
    {

        $occurrence = TaskOccurrence::create(
            $request->validated() + ['task_id' => $task->id]
        );

        return response()->json($occurrence, 201);

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
