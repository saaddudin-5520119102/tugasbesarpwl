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

    public function brands(){
        $user = Auth::user();
        $brands = Brand::all();
        return view('brand', compact('user', 'brands'));
    }

    // public function categories(){
    //     $user = Auth::user();
    //     $brands = Category::all();
    //     return view('category', compact('user', 'categories'));
    // }

    // mulai

    public function submit_brand(Request $req)
    {
        $brand =new Brand;

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

    // public function update_book(Request $req){
    //     $book = Book::find($req->get('id'));
    //     $book->judul = $req->get('judul');
    //     $book->penulis = $req->get('penulis');
    //     $book->tahun = $req->get('tahun');
    //     $book->penerbit = $req->get('penerbit');

    //     if($req->hasFile('cover')){
    //         $extension = $req->file('cover')->extension();
    //         $filename = 'cover_buku_'.time().'.'.$extension;
    //         $req->file('cover')->storeAs(
    //             'public/cover_buku', $filename
    //         );
    //         Storage::delete('public/cover_buku/'.$req->get('old_cover'));
    //         $book->cover = $filename;
    //     }

    //     $book->save();

    //     $notification = array(
    //         'message' => 'Data buku berhasil diubah',
    //         'alert-type' => 'success'
    //     );
    //     return redirect()->route('admin.books')->with($notification);
    // }
}
