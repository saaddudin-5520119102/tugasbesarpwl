<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Brand;
use App\Models\Category;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();
        return view('home', compact('user'));
    }


    // brands

    public function brands(){
        $user = Auth::user();
        $brands = Brand::all();
        return view('brand', compact('user', 'brands'));
    }


    public function submit_brand(Request $req)
    {
        $brand = new Brand;

        $brand->name = $req->get('name');
        $brand->description = $req->get('description');
        $brand->save();

        $notification = array(
            'message' => 'Data brand berhasil ditambahkan',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.brands')->with($notification);
        
    }

    public function getDataBrand($id){
        $brand = Brand::find($id);
        return response()->json($brand);
    }

    public function update_brand(Request $req){
        $brand = Brand::find($req->get('id'));
        $brand->name = $req->get('name');
        $brand->description = $req->get('description');
        $brand->save();
        


        $notification = array(
            'message' => 'Data brand berhasil diubah',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.brands')->with($notification);
    }

    public function delete_brand(Request $req){
        $brand = Brand::find($req->get('id'));
        $brand->delete();

        $notification = array(
            'message' => 'Data brand berhasil dihapus',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.brands')->with($notification);
    }


    // categories

     public function categories(){
        $user = Auth::user();
        $categories = Category::all();
        return view('category', compact('user', 'categories'));
    }

    public function submit_category(Request $req)
    {
        $category = new Category;

        $category->name = $req->get('name');
        $category->description = $req->get('description');
        $category->save();

        $notification = array(
            'message' => 'Data categori berhasil ditambahkan',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.categories')->with($notification);
        
    }

    public function getDataCategory($id){
        $category = Category::find($id);
        return response()->json($category);
    }

    public function update_category(Request $req){
        $category = Category::find($req->get('id'));
        $category->name = $req->get('name');
        $category->description = $req->get('description');
        $category->save();
        


        $notification = array(
            'message' => 'Data categori berhasil diubah',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.categories')->with($notification);
    }

    // public function delete_brand(Request $req){
    //     $brand = Brand::find($req->get('id'));
    //     $brand->delete();

    //     $notification = array(
    //         'message' => 'Data brand berhasil dihapus',
    //         'alert-type' => 'success'
    //     );
    //     return redirect()->route('admin.brands')->with($notification);
    // }
}
