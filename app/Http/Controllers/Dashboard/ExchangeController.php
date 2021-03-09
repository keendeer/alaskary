<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use App\Models\exchange;
use App\Models\branch;
use Illuminate\Http\Request;

class ExchangeController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
      //$this->authorizeResource(exchange::class, 'exchange');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = branch::where('type', '<', 3)->get();
        return view('layouts.exchange.index', [
                                                'branches'=> $branches, 
                                                'page_title' => 'تقارير الفروع / المخازن',
                                            ]);
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
     * @param  \App\Models\exchange  $exchange
     * @return \Illuminate\Http\Response
     */
    public function show(exchange $exchange)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\exchange  $exchange
     * @return \Illuminate\Http\Response
     */
    public function edit(exchange $exchange)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\exchange  $exchange
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, exchange $exchange)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\exchange  $exchange
     * @return \Illuminate\Http\Response
     */
    public function destroy(exchange $exchange)
    {
        //
    }
}
