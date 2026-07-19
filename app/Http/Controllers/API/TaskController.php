<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\TaskIndexRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TaskIndexRequest $request)
    {
        $validated = $request->validated();

        $query = Task::query();

        // Filtering
        if (array_key_exists('completed', $validated)) {
            $query->where('completed', filter_var($validated['completed'], FILTER_VALIDATE_BOOLEAN));
        }

        if (!empty($validated['search'])) {
            $query->where(function ($q) use ($validated) {
                $q->where('title', 'like', '%' . $validated['search'] . '%')
                ->orWhere('description', 'like', '%' . $validated['search'] . '%');
            });
        }

        // Sorting
        $sortField = $validated['sort_by'] ?? 'created_at';
        $sortDirection = $validated['sort_dir'] ?? 'desc';

        $query->orderBy($sortField, $sortDirection);

        // Pagination
        $perPage = $validated['per_page'] ?? 15;

        return $query->paginate($perPage);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
       Task::create([
            ...$request->validated(),
            'user_id' => Auth::id(),
        ]);

        return response()->json([
            'message' => 'Task Created Successfully!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::findOrFail($id);

        return $task;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, string $id)
    {
        $validated = $request->validated();

        $task = Task::findOrFail($id);

        $task->update($validated);

         return response()->json([
            'message' => 'Task Updated Successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);

        $task->delete();

        return response()->json([
            'message' => 'Task Deleted Successfully!'
        ]);
    }
}
