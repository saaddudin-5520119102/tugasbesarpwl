<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

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

    public function delete_category(Request $req){
        $category = Category::find($req->get('id'));
        $category->delete();

        $notification = array(
            'message' => 'Data kategori berhasil dihapus',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.categories')->with($notification);
    }


    // user
    public function barang(){
        $user = Auth::user();
        $barang = Product::all();
        $brands = Brand::all();
        $categories = Category::all();
        return view('barang', compact('user', 'barang', 'brands', 'categories'));
    }

    public function submit_barang(Request $req)
    {
        $barang = new Product;

        $barang->name = $req->get('name');
        $barang->qty = $req->get('qty');
        $barang->brands_id = $req->get('brands_id');
        $barang->categories_id = $req->get('categories_id');
        if($req->hasFile('photo')){
            $extension = $req->file('photo')->extension();
            $filename = 'photo_barang_'.time().'.'.$extension;
            $req->file('photo')->storeAs(
                'public/photo_barang', $filename
            );
            $barang->photo = $filename;
        }
        $barang->save();

        $notification = array(
            'message' => 'Data categori berhasil ditambahkan',
            'alert-type' => 'success'
        );
        return redirect()->route('user.barang')->with($notification);
        
    }

    public function getDataBarang($id){
        $barang = Product::find($id);
        return response()->json($barang);
    }

    public function update_barang(Request $req){
        $barang = Product::find($req->get('id'));
        $barang->name = $req->get('name');
        $barang->qty = $req->get('qty');
        $barang->brands_id = $req->get('brands_id');
        $barang->categories_id = $req->get('categories_id');

        if($req->hasFile('photo')){
            $extension = $req->file('photo')->extension();
            $filename = 'photo_buku_'.time().'.'.$extension;
            $req->file('photo')->storeAs(
                'public/photo_barang', $filename
            );
            Storage::delete('public/photo_barang/'.$req->get('old_photo'));
            $barang->photo = $filename;
        }
        $barang->save();
        
        $notification = array(
            'message' => 'Data barang berhasil diubah',
            'alert-type' => 'success'
        );
        return redirect()->route('user.barang')->with($notification);
    }

    public function delete_barang(Request $req){
        $barang = Product::find($req->get('id'));
        Storage::delete('public/photo_barang/'.$req->get('old_photo'));
        $barang->delete();

        $notification = array(
            'message' => 'Data barang berhasil dihapus',
            'alert-type' => 'success'
        );
        return redirect()->route('user.barang')->with($notification);
    }
}
