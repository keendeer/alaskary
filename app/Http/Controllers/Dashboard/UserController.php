<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\branch;
use App\Models\User;

use Session;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
      //$this->authorizeResource(User::class, 'User');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('layouts.user.index',   [
                                                'users'=> $users, 
                                                'page_title' => 'كل مستخدمين النظام',
                                                'module_name_ar' => 'مستخدم للنظام', 
                                                'module_name' => 'user.create'
                                            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = $branches = branch::all();
        return view('layouts.user.add', [
                                            'page_title' => 'اضافة مستخدم للنظام', 
                                            'branches' => $branches
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
        $store_user = User::create([
            'code' => $request->code,
            'name' => $request->cname,
            'tel' => $request->ctel,
            'branch_id' => $request->tree,
            'password' => Hash::make($request->spassword),
            'role' => $request->permissions,
            'desc' => $request->desc,
        ]);

        if($store_user){
            return response()->json([
                'success' => "تم اضافة المستخدم بنجاح !"  
            ]);
        }    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json([
            'success' => $user  
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $branches = $branches = branch::all();
        return view('layouts.user.edit', [
                                            'page_title' => 'تعديل مستخدم للنظام', 
                                            'user'=> $user, 
                                            'branches' => $branches
                                        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $password = $request->spassword;
        if($password != NULL){
            $password = Hash::make($password);    
        }else{
            $password = $user->password;   
        }
        $update = User::where('id', $user->id)->update([
            'name' => $request->cname,
            'tel' => $request->ctel,
            'branch_id' => $request->tree,
            'password' => $password,
            'role' => $request->permissions,
            'desc' => $request->desc,
        ]);

        if($update){
            return response()->json([
                'success' => 'تم تعديل المستخدم بنجاح !'   
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $remove_user = User::destroy($id);
        if($remove_user){
            return response()->json([
                'success' => 'تم حذف المستخدم بنجاح !'   
            ]);
        }
    }
}
