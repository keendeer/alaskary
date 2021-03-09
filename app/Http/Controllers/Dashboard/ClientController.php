<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use App\Models\client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
      $this->authorizeResource(client::class, 'client');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = client::all();
        return view('layouts.client.index', [
                                                'clients'=> $clients, 
                                                'page_title' => 'كل العملاء',
                                                'module_name_ar' => 'عميل', 
                                                'module_name' => 'client.create',
                                            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.client.add',[
                                            'page_title' => 'اضافة عميل'
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
            'code' => 'unique:clients',
            'name' => 'min:5|max:100',
            'address' => 'max:255',
            'tel' => 'nullable|min:8|max:11',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->getMessages()]);
        }

        $store_client = client::create([
            'code' => $request->code,
            'name' => $request->name,
            'tel' => $request->tel,
            'address' => $request->address,
            'email' => $request->email,
            'type' => $request->tree,
        ]);

        if($store_client){
            return response()->json([
                'success' => 'تم اضافة العميل بنجاح !'  
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(client $client)
    {
        return response()->json([
            'success' => $client,  
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(client $client)
    {
        return view('layouts.client.edit', [
                                                'page_title' => 'تعديل العميل', 
                                                'client'=> $client
                                            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, client $client)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'min:5|max:100',
            'address' => 'max:255',
            'tel' => 'nullable|min:8|max:11',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->getMessages()]);
        }

        $update = client::where('id', $client->id)->update([
            'name' => $request->name,
            'tel' => $request->tel,
            'address' => $request->address,
            'email' => $request->email,
            'type' => $request->tree,
        ]);

        if($update){
            return response()->json([
                'success' => 'تم تعديل العميل بنجاح !'  
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(client $client)
    {
        $remove_client = client::destroy($client->id);
        if($remove_client){
            return response()->json([
                'success' => 'تم حذف العميل بنجاح !'   
            ]);
        }
    }
}
