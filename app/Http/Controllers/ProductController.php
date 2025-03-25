<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = Product::paginate(10);
        return view('product.index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $result = Category::all(); //hien thi ten cac danh muc trong form them san pham
        return view('product.add', compact('result'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'sale' => 'nullable|numeric|min:0|max:100',
            'hot' => 'required|in:0,1',
            'description' => 'nullable|string',
            'img' => 'nullable|mimetypes:image/jpeg,image/png,image/gif,image/webp,image/svg+xml|max:5120',
            'content' => 'nullable|string',
            'status' => 'required|in:0,1',
            'total_pay' => 'nullable|integer|min:0',
            'total_rating' => 'nullable|integer|min:0',
            'total_stars' => 'nullable|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        try {
            if ($request->hasFile('img')) {
                $image = $request->file('img');
                $imgName = time() . "_" . $image->getClientOriginalName();
                $image->move(public_path('storage/imgproducts'), $imgName);
            } else {
                $imgName = null;
            }
            // Insert into database
            $product = Product::create([
                'name' => $request->name,
                'price' => (int) $request->price,
                'sale' => $request->sale ?? 0,
                'hot' => (int) $request->hot,  // Convert to integer
                'description' => $request->description ?? '',
                'img' => $imgName,
                'content' => $request->content ?? '',
                'status' => (int) $request->status,  // Convert to integer
                'total_pay' => intval($request->total_pay) ?: 0,
                'total_rating' => intval($request->total_rating) ?: 0,
                'total_stars' => intval($request->total_stars) ?: 0,
                'category_id' => (int) $request->category_id,  // Convert to integer
            ]);

            // If product creation is successful, move image
            if ($product) {

                return redirect()->route('product.index')->with('success', 'Thêm mới thành công');
            } else {
                return back()->with('error', 'Thêm mới thất bại');
            }
        } catch (\Exception $e) {
            dd($e->getMessage()); // Show error if something fails
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
        $result = Category::all(); //hien thi ten cac danh muc trong form them san pham
        return view('product.edit', compact('product', 'result'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'sale' => 'nullable|numeric|min:0|max:100',
            'hot' => 'required|in:0,1',
            'description' => 'nullable|string',
            'img' => 'nullable|mimetypes:image/jpeg,image/png,image/gif,image/webp,image/svg+xml|max:5120',
            'content' => 'nullable|string',
            'status' => 'required|in:0,1',
            'total_pay' => 'nullable|integer|min:0',
            'total_rating' => 'nullable|integer|min:0',
            'total_stars' => 'nullable|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imgName = time() . '_' . $image->getClientOriginalName(); // Avoid duplicate filenames
            $image->move(public_path('storage/imgproducts'), $imgName);
        } else {
            $imgName = $product->img; // Retain old image
        }

        // Thêm sản phẩm vào database
        $updated = $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'sale' => $request->sale ?? 0,
            'hot' => $request->hot,
            'description' => $request->description,
            'img' => $imgName,
            'content' => $request->content,
            'status' => $request->status,
            'total_pay' => $request->total_pay ?? 0,
            'total_rating' => $request->total_rating ?? 0,
            'total_stars' => $request->total_stars ?? 0,
            'category_id' => $request->category_id,
        ]);
        if ($updated) {
            return redirect()->route('product.index')->with('success', 'Cập nhật thành công');
        } else {
            return back()->with('error', 'Cập nhật thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Xóa thành công');
    }
    public function find(Request $request)
    {
        $result = Product::where('name', 'LIKE', $request->name)->get();
        return view('product.index', compact('result'));
    }
}
