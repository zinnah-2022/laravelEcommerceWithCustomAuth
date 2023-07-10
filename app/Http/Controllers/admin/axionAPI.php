<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class axionAPI extends Controller
{
    public function subcategory($id){
        $subcategory=DB::table('sub_categories')->where('category_id', $id)->get();
        return response()->json($subcategory);

    }
}
