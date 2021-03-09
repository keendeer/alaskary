<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use App\Models\credit_payment;
use Illuminate\Http\Request;

class CreditPaymentController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
      $this->authorizeResource(credit_payment::class, 'credit_payment');
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
     * @param  \App\Models\credit_payment  $credit_payment
     * @return \Illuminate\Http\Response
     */
    public function show(credit_payment $credit_payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\credit_payment  $credit_payment
     * @return \Illuminate\Http\Response
     */
    public function edit(credit_payment $credit_payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\credit_payment  $credit_payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, credit_payment $credit_payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\credit_payment  $credit_payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(credit_payment $credit_payment)
    {
        //
    }
}
