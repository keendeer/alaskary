<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use App\Models\branch_item;
use App\Models\item;
use App\Models\exchange;
use Illuminate\Http\Request;

class BranchItemController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
      //$this->authorizeResource(branch_item::class, 'branch_item');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('layouts.itemtobranch.index', ['page_title' => 'كل الفروع / المخازن']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stock = NULL;
        if($request->stock){
            $stock = $request->stock;
            branch_item::updateOrInsert([
                'branch_id' => $request->stock,
                'item_id' => $request->product,
            ])->decrement('quantity', $request->qty);
            $store_exchange = exchange::create([
                'branch' => $request->stock,
                'stock' => $request->branch,
                'item_id' => $request->product,
                'quantity' => -$request->qty,
                'process' => 5,
            ]);
        }

        $store_branch_item = branch_item::updateOrInsert([
            'branch_id' => $request->branch,
            'item_id' => $request->product,
        ])->increment('quantity', $request->qty);

         if($store_branch_item){
            $store_exchange = exchange::create([
                'branch' => $request->branch,
                'stock' => $stock,
                'item_id' => $request->product,
                'quantity' => $request->qty,
                'process' => $request->type,
            ]);

            if($store_exchange){
                return response()->json([
                    'success' => "تم اضافة المنتج الى الفرع / المخزن بنجاح !"  
                ]);
            }
         } 
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\branch_item  $branch_item
     * @return \Illuminate\Http\Response
     */
    public function show(branch_item $branch_item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\branch_item  $branch_item
     * @return \Illuminate\Http\Response
     */
    public function edit(branch_item $branch_item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\branch_item  $branch_item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, branch_item $branch_item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\branch_item  $branch_item
     * @return \Illuminate\Http\Response
     */
    public function destroy(branch_item $branch_item)
    {
        //
    }
}
