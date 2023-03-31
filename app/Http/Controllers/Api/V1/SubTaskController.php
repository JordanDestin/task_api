<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Theme;
use App\Models\Task;
use App\Models\Subtasks;
use App\Http\Resources\SubtaskResource;
use App\Http\Requests\StoreSubtaskRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SubTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Theme $theme, Task $task)
    {
        $subtask = Subtasks::where('task_id', $task->id)->latest()->get();

        return SubtaskResource::collection($subtask);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubtaskRequest $request, Theme $theme, Task $task)
    {
        $data = $request->validated();
        $data['task_id'] = $task->id;

        $subtask = Subtasks::create($data);
        
        return response()->json(200);           
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Theme $theme,Task $task, Subtask $subtask)
    {
        $updateSubtask = Subtask::where("id", $subtask->id)
                    ->update([
                        "validate" => $request->validate
                    ]);
        
        return response()->json(200);

    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Theme $theme, Task $task, Subtask $subtask)
    {
        $subtask->delete();
        return response()->noContent();
    }
}
