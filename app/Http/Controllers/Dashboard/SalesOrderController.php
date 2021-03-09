<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use App\Models\sales_order;
use App\Models\item;
use App\Models\client;
use App\Models\employee;
use App\Models\branch;

use App\Jobs\SalesOrderProcess;
use Illuminate\Http\Request;

use Auth;

class SalesOrderController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
      //$this->authorizeResource(sales_order::class, 'sales_order');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$employees;
        switch (Auth::user()->branch->type) {
            case '0':
            case '1':
                $employees = null;
                break;
            case '2':
                $employees = employee::where('user_id', Auth::id())->get();    
                break;
            default:
                $employees = employee::all();
                break;        
        }*/
        //$sales_order = sales_order::all();




        /*$branches;
        switch (Auth::user()->branch->type) {
            case '0':
                $branches = branch::where('type', 1)->get();
                $branches[] = Auth::user()->branch; 
                break;
            case '1':
                $branches = branch::where('type', 2)->get();
                break;
            case '2':
                    $branches[] = Auth::user()->branch;
                    //return $branches;
                    break;    
            default:
                $branches = branch::all();
                break;
        }*/
        //$branches = branch::where('type', 2)->get();

        $branches;
        switch (Auth::user()->branch->type) {
            case '0':
            case '1':
                $branches = [];
                break;
            case '2':
                $branches = Auth::user()->branch;
                
                break;    
            default:
                $branches = branch::where('type', 2)->get();
                break;
        }

        //return Auth::user()->branch->user[0]->employee;
        //return $branches = Auth::user()->employee;

        //if(Auth::user()->branch->type === 3){
            //$branches = branch::where('type', 2)->get();
        //}

        //return $branches;

        return view('layouts.salesorder.index1', [
                                                    'branches'=>$branches,
                                                    
                                                    'page_title' => 'كل اوامر البيع', 
                                              
                                                    'module_name_ar' => 'امر بيع', 
                                                    'module_name' => 'salesorder.create'
                                                ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $items = item::all();
        $clients = client::all();
        $employees = employee::all();
        return view('layouts.salesorder.add', [
                                                'page_title' => 'اضافة امر بيع', 
                                                'items' => $items,
                                                'clients' => $clients,   
                                                'employees' => $employees,                             
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

        $sales_order_store = sales_order::create([
            'code' => $request->codegen,
            'total' => $request->gtotal,
            'tax' => $request->tax,
            'client_id' => $request->client_id,
            'employee_id' => $request->employee_id,
            'discount' => $request->discount,
        ]);

        if($sales_order_store){
            /*foreach ($request->myFormJson['items'] as $value) {
                $sales_order_item_store = sales_order_item::create([
                    'order_id' => $sales_order_store->id,
                    'item_id' => $value['itemid'],
                    'quantity' => $value['pquantity'],
                    'total' => $value['pamount'],
                ]);

                if($sales_order_item_store){
                    $sales_order_item_store_and_branch = branch_item::updateOrInsert([
                    'branch_id' => 4,
                    'item_id' => $value['itemid'],
                    ])->decrement('quantity', $value['pquantity']);
                }

                if($sales_order_item_store_and_branch){
                    $store_exchange = exchange::create([
                        'branch' => 4,
                        'stock' => NULL,
                        'item_id' => $value['itemid'],
                        'quantity' => -$value['pquantity'],
                        'process' => 3,
                    ]);
                }
            }*/
            SalesOrderProcess::dispatch($request->myFormJson['items'], $sales_order_store->id, Auth::user()->branch->id);
            return response()->json([
                'success' => 'تم اضافة العميل بنجاح !'  
            ]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sales_order  $sales_order
     * @return \Illuminate\Http\Response
     */
    public function show(sales_order $sales_order)
    {
        $branches;
        switch (Auth::user()->branch->type) {
            case '0':
            case '1':
                $branches = [];
                break;
            case '2':
                $branches = Auth::user()->branch;
                
                break;    
            default:
                $branches = branch::where('type', 2)->get();
                break;
        }

        //return Auth::user()->branch->user[0]->employee;
        //return $branches = Auth::user()->employee;

        //if(Auth::user()->branch->type === 3){
            //$branches = branch::where('type', 2)->get();
        //}

        //return $branches;

        return view('layouts.salesorder.show', [
                                                    'branches'=>$branches,
                                                    
                                                    'page_title' => 'كل اوامر البيع', 
                                              
                                                    'module_name_ar' => 'امر بيع', 
                                                    //'module_name' => 'salesorder.create'
                                                ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sales_order  $sales_order
     * @return \Illuminate\Http\Response
     */
    public function edit(sales_order $sales_order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sales_order  $sales_order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sales_order $sales_order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sales_order  $sales_order
     * @return \Illuminate\Http\Response
     */
    public function destroy(sales_order $sales_order)
    {
        //
    }
}
