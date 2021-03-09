<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use App\Models\employee_timeline;
use Illuminate\Http\Request;

class EmployeeTimelineController extends Controller
{
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
        $employee_timeline = employee_timeline::create([
            'employee_id' => $request->employee_id,
            
            
        ]);

        if($employee_timeline){
            return response()->json([
                'success' => 'تم فتح يوم بيع جديد !'  
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\employee_timeline  $employee_timeline
     * @return \Illuminate\Http\Response
     */
    public function show(employee_timeline $employee_timeline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employee_timeline  $employee_timeline
     * @return \Illuminate\Http\Response
     */
    public function edit(employee_timeline $employee_timeline)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\employee_timeline  $employee_timeline
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, employee_timeline $employee_timeline)
    {
        $update = employee_timeline::where('id', $employee_timeline->id)->update([
            'total' => $request->total,
            
        ]);

        if($update){
            return response()->json([
                'success' => 'تم اغلاق يوم البيع '   
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\employee_timeline  $employee_timeline
     * @return \Illuminate\Http\Response
     */
    public function destroy(employee_timeline $employee_timeline)
    {
        //
    }
}
