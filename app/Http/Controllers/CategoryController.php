<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('created_at','desc')->paginate(5);
        return response()->json($categories,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'image' => 'required|image|mimes:jpeg,bmp,png'
        ]);
        $category = new Category();
        $category->name = $request->name;
        $path = $request->file('image')->store('categories_images');
        $category->image = $path;
        if($category->save()){
            return response()->json($category,200);
        }else{
            return response()->json([
                'message' => 'Some error occurred , Please try again !',
                'status_code' => 500   
            ], 500);            
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // dd($request->all(),$category);
        $request->validate([
            'name' => 'required|min:3',
        ]);

        $category->name = $request->name;
        $oldPath = $category-> image;
        if($request->hasFile('image')){
            $request->validate([
                'image' => 'image|mines:jpeg,png,jpg' ,
            ]);
            $path = $request->file('image')->store('categories_images');
            $category->image = $path;

            Storage::delete($oldPath);
        }

        if($category->save()){
            return response()->json($category,200);
        } else{
            Storage::delete($path);
            return response()->json([
                'message' => 'Some error occurred , Please try again !',
                'status_code' => 500   
            ], 500);            
        }

        dd($request->all(),$category);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->delete()){
            Storage::delete($category->image);
            return response()->json([
                'message' => 'Category deleted successfuly !',
                'status_code' => 200
            ],200);
        }else {
            return response()->json([
                'message' => 'Error !',
                'status_code' => 500
            ],500);
        }
    }
}
