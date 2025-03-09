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
        return view('categorymanager.themdanhmuc');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //kiểm tra tên file (validate)
        $caategory = Category::create([
            'name' =>$request->name,
            'describe'=> $request->description,
            'img' => $request->file('img')->getClientOriginalName(),
            'status' => $request->status,
        ]);
        if($caategory){
            $image = $request->file('img');
            $imgName = $image->getClientOriginalName(); 
            $image->move(public_path('storage/imgcategories'), $imgName);
            return redirect()->route('qldanhmuc.index');
        }else{
            //thong bao loi
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
        $category->update([
            'name' =>$request->name,
            'describe'=> $request->description,
            'img' => $request->file('img')->getClientOriginalName(),
            'status' => $request->status,
        ]);
        if($category){
            $image = $request->file('img');
            $imgName = $image->getClientOriginalName(); 
            $image->move(public_path('storage/imgcategories'), $imgName);
            return redirect()->route('qldanhmuc.index');
        }else{
            //thong bao loi
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
