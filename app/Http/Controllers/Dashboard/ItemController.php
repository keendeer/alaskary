<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use App\Models\item;
use App\Models\category;
use App\Models\branch_item;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
      $this->authorizeResource(item::class, 'item');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = item::all();
        return view('layouts.item.index', [
                                            'items'=> $items, 
                                            'page_title' => 'كل المنتجات',
                                            'module_name_ar' => 'منتج', 
                                            'module_name' => 'item.create',
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
        return view('layouts.item.add', [
                                            'timer'=> 0, 
                                            'categories'=> $categories, 
                                            'page_title' => 'اضافة منتج'
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
            'code' => 'max:100|unique:items',
            'name' => 'max:100|unique:items',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->getMessages()]);
        }

        $store_item = item::create([
            'code' => $request->code ,
            'name' => $request->name ,
            'boxqt' => $request->boxqt,
            'gprice' => $request->gprice,
            'price' => $request->tprice,
            'category_id' => $request->tree,
        ]);

        if($store_item){
            return response()->json([
                'success' => 'تم اضافة المنتج بنجاح !'  
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(item $item)
    {
        return response()->json([
            'item' => $item, 
            'category' => $item->category->name
        ]);
    }

    public function getQuantity(Request $request){
        return branch_item::where([['item_id', '=', $request->product],['branch_id', '=', $request->branch]])->first()->quantity;
    }

    public function itemForInvoice(Request $request){
        $item = item::where('code', $request->code)->first();
        return response()->json([
            'item' => $item ,
            'category' => $item->category->name  
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(item $item)
    {
        $categories = category::whereNull('category_id')->with('subCategory')->get();
        return view('layouts.item.edit', [
                                            'timer'=> 0, 
                                            'page_title' => 'تعديل المنتج', 
                                            'item'=> $item, 
                                            'categories' => $categories
                                        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, item $item)
    {
        $validator = Validator::make($request->all(),[
            'code' => [Rule::unique('items')->ignore($item->id)],
            'name' => [Rule::unique('items')->ignore($item->id),'max:100'],
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->getMessages()]);
        }

        $update = item::where('id', $item->id)->update([
            'code' => $request->code ,
            'name' => $request->name ,
            'boxqt' => $request->boxqt,
            'gprice' => $request->gprice,
            'price' => $request->tprice,
            'category_id' => $request->tree,
        ]);

        if($update){
            return response()->json([
                'success' => 'تم تعديل المنتج بنجاح !'   
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(item $item)
    {
        $remove_item = item::destroy($item->id);
        if($remove_item){
            return response()->json([
                'success' => 'تم حذف المنتج بنجاح !'   
            ]);
        }
    }
}
