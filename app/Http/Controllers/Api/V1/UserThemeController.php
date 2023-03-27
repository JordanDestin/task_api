<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserThemeResource;
use App\Models\ThemeUser;
use App\Models\Theme;
use App\Models\User;
use App\Models\Role;

class UserThemeController extends Controller
{
    public function index(Theme $theme)
    {
        $listUserTheme = DB::table('theme_user')
                        ->join('users','users.id','=','theme_user.user_id')
                        ->join('roles','role_id','=','roles.id')
                        ->where('theme_id',$theme->id)
                        ->get();

        return UserThemeResource::collection($listUserTheme);
    }

    public function store(Request $request, $theme )
    {        
        $user = User::where('email', $request->email)->first(); 
        $user->themes()->attach($theme, ['role_id'=>2]);

        return response()->json(200);
    }

    public function destroy(Theme $theme, $id)
    {
        $userTheme = ThemeUser::where('theme_id',$theme->id)
        ->where('user_id',$id)
        ->delete();
        return response()->noContent();
    }
}
