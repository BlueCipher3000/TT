<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = Product::paginate(10);
        return view('productmanager.qlsanpham',compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $result = Category::all();//hien thi ten cac danh muc trong form them san pham
        return view('productmanager.themsanpham',compact('result'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'sale' => 'nullable|integer|min:0|max:100',
            'hot' => 'required|boolean',
            'description' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'nullable|string',
            'status' => 'required|boolean',
            'total_pay' => 'nullable|integer|min:0',
            'total_rating' => 'nullable|integer|min:0',
            'total_stars' => 'nullable|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Thêm sản phẩm vào database
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'sale' => $request->sale ?? 0,
            'hot' => $request->hot,
            'description' => $request->description,
            'img' => $request->file('img')->getClientOriginalName(),
            'content' => $request->content,
            'status' => $request->status,
            'total_pay' => $request->total_pay ?? 0,
            'total_rating' => $request->total_rating ?? 0,
            'total_stars' => $request->total_stars ?? 0,
            'category_id' => $request->category_id,
        ]);
        if($product){
            $image = $request->file('img');
            $imgName = $image->getClientOriginalName();
            $image->move(public_path('storage/imgproducts'), $imgName);
            return redirect()->route('qlsanpham.index');
        }else{
            //thong bao loi
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
        $result = Category::all();//hien thi ten cac danh muc trong form them san pham
        return view('productmanager.suasanpham',compact('product','result'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'sale' => 'nullable|integer|min:0|max:100',
            'hot' => 'required|boolean',
            'description' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'nullable|string',
            'status' => 'required|boolean',
            'total_pay' => 'nullable|integer|min:0',
            'total_rating' => 'nullable|integer|min:0',
            'total_stars' => 'nullable|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Thêm sản phẩm vào database
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'sale' => $request->sale ?? 0,
            'hot' => $request->hot,
            'description' => $request->description,
            'img' => $request->file('img')->getClientOriginalName(),
            'content' => $request->content,
            'status' => $request->status,
            'toyal_pay' => $request->toyal_pay ?? 0,
            'total_rating' => $request->total_rating ?? 0,
            'total_stars' => $request->total_stars ?? 0,
            'category_id' => $request->category_id,
        ]);
        if($product){
            $image = $request->file('img');
            $imgName = $image->getClientOriginalName();
            $image->move(public_path('storage/imgproducts'), $imgName);
            return redirect()->route('qlsanpham.index');
        }else{
            //thong bao loi
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        $product->delete();
        return redirect()->route('qlsanpham.index');
    }
    public function find(Request $request){
        $result = Product::where('name','LIKE',$request->name)->get();
        return view('productmanager.qlsanpham',compact('result'));
    }
}
