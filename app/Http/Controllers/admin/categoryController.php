<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.page.category.category_view');

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.category.create');
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
                'name'=>'required|',
                'status'=>'required',
                'image'=>'required'
            ]);
            if ($request->image){
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('images/category'), $imageName);
            }
            DB::table('categories')->insert([
                'name'=>$request->name,
                'slug'=>Str::slug($request->name),
                'status'=>$request->status,
                'image'=>$imageName
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
        $categoryEdit=DB::table('categories')->find($id);
        return view('admin.page.category.edit', ['data'=>$categoryEdit]);
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
                'name'=>'required',
                'status'=>'required'
            ]);
            DB::table('categories')->where('id', $id)->update([
                'name'=>$request->name,
                'slug'=>Str::slug($request->name),
                'status'=>$request->status,
                'created_at'=>carbon::now()
            ]);
        }catch(\Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
        return redirect()->route('category.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $uncategory=DB::table('uncategories')->first();
        $teacher=DB::table('categories')->find($id);
        $image_path = public_path('images/category/') . $teacher->image;
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        if (DB::table('categories')->where('id', $id)->delete()){
           $subID= DB::table('sub_categories')->where('category_id', $id)->get();
           for ($i=1; $i<=count($subID); $i++){
               DB::table('sub_categories')->update([
                   'category_id'=>$uncategory->id[$i]
               ]);
           }
        }
    }
    public function userview(){
        $category=DB::table('categories')->get();
        return response()->json($category);
    }
}
