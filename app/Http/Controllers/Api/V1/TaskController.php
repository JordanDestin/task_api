<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Category;
use App\Models\Task;
use App\Models\Theme;
use App\Models\Subtask;
use App\Models\Statutes;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Theme $theme): JsonResponse
    {
        $tasks = Task::where('theme_id', $theme->id)->where('statutes_id', 1)->get();
        $tasksInProgress = Task::where('theme_id', $theme->id)->where('statutes_id', 2)->get();
        $tasksPending = Task::where('theme_id', $theme->id)->where('statutes_id', 3)->get();
        $tasksResolved = Task::where('theme_id', $theme->id)->where('statutes_id', 4)->get();
      
        return response()->json([
            "listTask" =>$tasks,
            "tasksInProgress" => $tasksInProgress,
            "tasksPending" => $tasksPending,
            "tasksResolved" => $tasksResolved,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $theme): JsonResponse
    {

       // dd( $request->category);
      /*  $data = $request->validate([
            'title' => ['required','max:100', new checkTaskExist($team)],
            'detail' => 'required|max:500',
        ]);*/
        if($request->category == null)
        {
            $request->category = 1;
        }

        $task = Task::create([
            "title" => $request->title,
            "detail"=> $request->detail,
            "statutes_id" => 1,
            "theme_id" => $theme,
            "category_id" => $request->category
        ]);

        return response()->json(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Theme $theme, Task $task)
    {
        return response()->json([
            'task'=>$task,
        ], 200);
    }

    public function updateStatusTask(Request $request, Theme $theme, Task $task)
    {
        $updateStatusTask = DB::table('tasks')
        ->where('id', $task->id)
        ->where('theme_id', $theme->id)
        ->update(['statutes_id'=>$request->idStatus]);

        return response()->json(200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Theme $theme, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Theme $theme, Task $task)
    {     
        $task->delete();

        return response()->json(200);
    }
}
