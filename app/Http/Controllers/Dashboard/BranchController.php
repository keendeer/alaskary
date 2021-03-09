<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use App\Models\branch;
use App\Models\item;
use App\Models\category;
use App\Models\branch_item;
use App\Models\exchange;

use Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;


use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
      $this->authorizeResource(branch::class, 'branch');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches;
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
        }
                
        
        
        return view('layouts.branch.index', [
                                                'branches'=> $branches, 
                                                'page_title' => 'كل الفروع / المخازن',
                                                'module_name_ar' => 'فرع / مخزن', 
                                                'module_name' => 'branch.create'
                                            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $branches = branch::all();
        return view('layouts.branch.add', [
                                            'branches'=> $branches, 
                                            'page_title' => 'اضافة فرع / مخزن جديد'
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
            'code' => 'unique:branches',
            'name' => 'min:5|max:100|unique:branches',
            'address' => 'max:255',
            'tel' => 'nullable|min:8|max:11',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->getMessages()]);
        }

        $store_branch = branch::create([
            'code' => $request->code,
            'name' => $request->name,
            'type' => $request->tree ,
            'address' => $request->address,
            'tel' => $request->tel,
        ]);

        if($store_branch){
            return response()->json([
                'success' => 'تم اضافة الفرع / المخزن بنجاح !'  
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(branch $branch)
    {
        $branch_item = branch_item::where('branch_id', $branch->id)->get();
        $items = item::all();
        $branches = branch::where('type', 0)->get();
        $subbranches = branch::where('type', 1)->get();
        $categories = category::whereNull('category_id')->with('subCategory')->get();
        return view('layouts.branch.show', ['timer'=> 0, 'categories'=> $categories, 'branch_item' => $branch_item ,'branch' => $branch ,'items' => $items ,'page_title' => $branch->name, 'branches' => $branches, 'subbranches' => $subbranches]);
    }

    public function branchExchange(branch $branch, exchange $exchange){
        $exchanges = $exchange->where('branch', $branch->id)->get();
        return view('layouts.exchange.show', [
                                                'exchanges' => $exchanges,
                                                'page_title' => 'حركات '.$branch->name
                                            ]);    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(branch $branch)
    {
        return view('layouts.branch.edit', [
                                            'page_title' => 'تعديل الفرع / المخزن', 
                                            'branch' => $branch
                                        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, branch $branch)
    {
        $validator = Validator::make($request->all(),[
            'name' => [Rule::unique('branches')->ignore($branch->id), 'min:5','max:100'],
            'address' => 'max:255',
            'tel' => 'nullable|min:8|max:11',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->getMessages()]);
        }

        $update = branch::where('id', $branch->id)->update([
            'name' => $request->name,
            'type' => $request->tree,
            'address' => $request->address,
            'tel' => $request->tel,
        ]);

        if($update){
            return response()->json([
                'success' => 'تم تعديل الفرع / المخزن بنجاح !'   
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(branch $branch)
    {
        $remove_branch = branch::destroy($branch->id);
        if($remove_branch){
            return response()->json([
                'success' => 'تم حذف الفرع / المخزن بنجاح !'   
            ]);
        }
    }
}
