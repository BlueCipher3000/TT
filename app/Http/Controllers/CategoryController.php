<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = Category::paginate(10);
        return view('categorymanager.qldanhmuc',compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $result = Category::all();
        return view('categorymanager.themdanhmuc', compact('result'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $image = $request->file('img');
        $imgName = $image ? $image->getClientOriginalName() : 'default.png';
        //kiểm tra tên file (validate)
        $category = Category::create([
            'name' =>$request->name,
            'describe'=> $request->description,
            'img' => $imgName,
            'status' => $request->status,
        ]);
        if($category){
            if ($image)
                $image->move(public_path('storage/imgcategories'), $imgName);
            return redirect()->route('qldanhmuc.index')->with('success','Thêm mới thành công');
        }else{
            return back()->with('error','Thêm mới thất bại');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categorymanager.suadanhmuc',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $image = $request->file('img');
        $imgName = $category->img;
        //kiểm tra tên file (validate)
        $updated = $category->update([
            'name' => $request->name,
            'description'=> $request->description,
            'img' => $imgName,
            'status' => $request->status,
        ]);
        if($updated){
            if ($image)
                $image->move(public_path('storage/imgcategories'), $imgName);
            return redirect()->route('qldanhmuc.index')->with('success','Cập nhật thành công');
        }else{
            return back()->with('error','Cập nhật thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        $category->delete();
        return redirect()->route('qldanhmuc.index');
    }

    public function Find(Request $request){
        $result = Category::where('name','LIKE',$request->name)->get();
        return view('categorymanager.qldanhmuc',compact('result'));
    }
}
