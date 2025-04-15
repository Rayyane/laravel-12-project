<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index() {
        // dd(Auth::user());
        // return TaskResource::collection(Auth::user()->tasks()->get());
        // return response()->json(Auth::user());
        return TaskResource::collection(Auth::user()->tasks()->get());

        // if (!$user) {
        //     return response()->json(['error' => 'Unauthenticated'], 401);
        // }

        // $tasks = $user->tasks()->get();

        // return TaskResource::collection($tasks);
    }

    public function store(StoreTaskRequest $request) {
        $task = $request->user()->tasks()->create($request->validated());

        return TaskResource::make($task);
    }

    public function show(Task $task) {
        return TaskResource::make($task);
    }

    public function update(UpdateTaskRequest $request, Task $task) {
        $task->update($request->validated());

        return TaskResource::make($task);
    }

    public function destroy(Task $task) {
        $task->delete();

        return response()->noContent();
    }
}
