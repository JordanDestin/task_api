<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreThemeRequest;
use App\Models\User;
use App\Models\Theme;
use App\Models\Task;
use App\Http\Resources\UserThemeResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class ThemeController extends Controller
{
    public function index()
    {
        $listThemes = DB::table('theme_user')
        ->join('themes','theme_id','=','themes.id')
        ->join('roles','role_id','=','roles.id')
        ->where('user_id',Auth::id())
        ->get();
        
         return response()->json([
            'listThemes'=>$listThemes
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreThemeRequest $request): JsonResponse
    {        
        $data = $request->validated();
        $theme = Theme::create($data);

        $user = User::find(Auth::id());  
        
        $user->themes()->attach($theme->id, ['role_id'=>1]);

        return response()->json(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Theme $theme): JsonResponse
    {
        // $tasks = Task::where('theme_id',$theme->id)->latest()->get();
      
        // return response()->json([
        //     'listTask'=>$tasks
        // ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Theme $theme)
    {
       // dd($theme);
        $theme->delete();

        return response()->noContent();
    }
}
