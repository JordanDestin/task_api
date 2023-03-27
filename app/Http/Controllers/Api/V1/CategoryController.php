<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Category;
use App\Models\Task;
use App\Models\Theme;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Theme $theme): JsonResponse
    {
        $categories = Theme::find($theme->id)->categories()->get();
 
        return response()->json([
            'listCategories'=>$categories
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Theme $theme, Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|max:100'
        ]);

        $category = Category::create([
            "name" => $request->name
        ]);

        $themecateg = Theme::where('id',$theme->id)->first();


        $themecateg->categories()->attach($category->id);
        
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
    public function update(Request $request,Theme $theme, Category $category): JsonResponse
    {
        Category::where('id', $category->id)
        ->update(['name' => $request->name]);
        return response()->json(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Theme $theme, Category $category)
    {
        $category->delete();
        return response()->json(200);
    }
}
