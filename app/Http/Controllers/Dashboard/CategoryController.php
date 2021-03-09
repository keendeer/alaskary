<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use App\Models\category;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
      $this->authorizeResource(category::class, 'category');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = category::whereNull('category_id')->with('subCategory')->get();
        return view('layouts.category.index', [
                                                'timer'=> 1, 
                                                'categories'=> $categories, 
                                                'page_title' => 'كل التصنيفات',
                                                'module_name_ar' => 'تصنيف', 
                                                'module_name' => 'category.create'
                                            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = category::whereNull('category_id')->with('subCategory')->get();
        return view('layouts.category.add', [
                                                'timer'=> 0, 
                                                'categories'=> $categories, 
                                                'page_title' => 'اضافة تصنيف جديد'
                                            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'code' => 'unique:categories',
            'name' => 'min:3|max:100',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->getMessages()]);
        }

        $category_id = NULL;
        if($request->tree < 1){
            $category_id = NULL;
            
        }else{
            $category_id = $request->tree;
        }

         $store_category = category::create([
            'code' => $request->code,
            'name' => $request->name,
            'category_id' => $category_id,
        ]);

        if($store_category){
            return response()->json([
                'success' => 'تم اضافة التصنيف بنجاح !'  
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        return response()->json([
            'success' => $category->item  
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        $categories = category::whereNull('category_id')->with('subCategory')->get();
        return view('layouts.category.edit', [
                                                'page_title' => 'تعديل التصنيف', 
                                                'categoryy' => $category, 
                                                'categories'=> $categories, 
                                                'timer'=> 0 
                                            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'min:3|max:100',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->getMessages()]);
        }

        $category_id = NULL;
        if($request->tree < 1){
            $category_id = NULL;
            
        }else{
            $category_id = $request->tree;
        }

        $update = category::where('id', $category->id)->update([
            'name' => $request->name,
            'category_id' => $category_id,
        ]);

        if($update){
            return response()->json([
                'success' => 'تم تعديل التصنيف بنجاح !'   
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        $remove_category = category::destroy($category->id);
        if($remove_category){
            return response()->json([
                'success' => 'تم حذف التصنيف بنجاح !'   
            ]);
        }
    }
}
