<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use App\Models\sales_order_item;
use Illuminate\Http\Request;

class SalesOrderItemController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
      $this->authorizeResource(sales_order_item::class, 'sales_order_item');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sales_order_item  $sales_order_item
     * @return \Illuminate\Http\Response
     */
    public function show(sales_order_item $sales_order_item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sales_order_item  $sales_order_item
     * @return \Illuminate\Http\Response
     */
    public function edit(sales_order_item $sales_order_item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sales_order_item  $sales_order_item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sales_order_item $sales_order_item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sales_order_item  $sales_order_item
     * @return \Illuminate\Http\Response
     */
    public function destroy(sales_order_item $sales_order_item)
    {
        //
    }
}
