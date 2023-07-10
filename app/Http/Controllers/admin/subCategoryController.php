<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\subCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class subCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $ddd=DB::table('uncategories')->first();
      $subCategories=DB::table('categories')->rightJoin('sub_categories', 'categories.id','=','sub_categories.category_id')->get();
        return view('admin.page.sub_category.view',['subCategory'=>$subCategories, 'uncategory'=>$ddd]);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sub_category=DB::table('categories')->get();
        return view('admin.page.sub_category.create', ['subcategory'=>$sub_category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name'=>'required',
                'category_id'=>'required',
                'status'=>'required',
            ]);
            DB::table('sub_categories')->insert([
                'sub_name'=>$request->name,
                'category_id'=>$request->category_id,
                'sub_slug'=>Str::slug($request->name),
                'sub_status'=>$request->status,
                'created_at'=>carbon::now()
            ]);
        }catch(\Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sub_category=DB::table('categories')->get();
        $Esubcategory=DB::table('sub_categories')->find($id);
        return view('admin.page.sub_category.update', ['Esubcategory'=>$Esubcategory,'subcategory'=>$sub_category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'sub_name'=>'required',
                'category_id'=>'required',
                'sub_status'=>'required',
            ]);
            DB::table('sub_categories')->where('id', $id)->update([
                'sub_name'=>$request->sub_name,
                'category_id'=>$request->category_id,
                'sub_slug'=>Str::slug($request->sub_name),
                'sub_status'=>$request->sub_status,
                'updated_at'=>carbon::now()
            ]);
        }catch(\Exception $e) {
            echo 'Message: ' .$e->getMessage();
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
        DB::table('sub_categories')->where('id', $id)->delete();
    }
}
