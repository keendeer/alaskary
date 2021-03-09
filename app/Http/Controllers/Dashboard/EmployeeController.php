<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use App\Models\employee;
use App\Models\User;
use Illuminate\Http\Request;

use Auth;

class EmployeeController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
      //$this->authorizeResource(employee::class, 'employee');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$employees = employee::where('user_id', Auth::id())->get();
        $employees;
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
        }
        //return $employees;
        /*$employees = employee::all();*/
        return view('layouts.employee.index',   [
                                                    'employees'=> $employees, 
                                                    'page_title' => 'كل البائعين',
                                                    'module_name_ar' => 'بائع', 
                                                    'module_name' => 'employee.create'
                                                ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('layouts.employee.add', [
                                                'page_title' => 'اضافة بائع', 
                                                'users' => $users
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
        $store_employee = employee::create([
            'code' => $request->code,
            'name' => $request->cname,
            'tel' => $request->ctel,
            'user_id' => $request->tree,
            'desc' => $request->desc,
        ]);

         $success = "";

         if($store_employee){
            $success = "تم اضافة الفرع / المخزن بنجاح !";
         }else{
            $success = "حدث خطأ ما برجاء مراجعة البيانات المدخلة !";
         } 

        return response()->json([
            'success' => $success  
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(employee $employee)
    {
        $users = User::all();
        return view('layouts.employee.edit', ['page_title' => 'تعديل البائع', 'users'=> $users, 'employee' => $employee]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, employee $employee)
    {
        $update = employee::where('id', $employee->id)->update([
            'name' => $request->cname,
            'tel' => $request->ctel,
            'user_id' => $request->tree,
            'desc' => $request->desc,
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
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(employee $employee)
    {
        $remove_employee = employee::destroy($employee->id);
        if($remove_employee){
            return response()->json([
                'success' => 'تم حذف الفرع / المخزن بنجاح !'   
            ]);
        }
    }
}
