<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $result = User::orderBy('id','ASC')->paginate(10);
        return view('usermanager.qluser',compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()//trả về view thêm mới khách hàng
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)//thêm khách hàng vào database
    {
        // $request->validate([
        //     'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);
        $image = $request->file('img');
        $imgName = $image->getClientOriginalName(); 
        if($request->role == 1){
            $image->move(public_path('storage'), $imgName);
        }else{
            $image->move(public_path('storage/imgusers'), $imgName);
        }
        $user = User::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => $request->password,
            'address' => $request->address,
            'img' => $imgName,
            'role' => $request->role,
            'statu' => $request->statu,
        ]);
        if($user){
            return redirect()->route('qlkhachhang.index');
        }else{
            echo "Không thành công";
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $khachhang)
    {
        return view('usermanager.suakhachhang',compact('khachhang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $khachhang)
    {
        $image = $request->file('img');
        if($image){
            $imgName = $image->getClientOriginalName(); 
        }
        if($request->role == 1){//kiem tra file anh vua sua co ton tai trong store khong neu kho thi them anh vao store
            $filePath = public_path('storage/' . $imgName);

            if (!File::exists($filePath)) {
                $image->move(public_path('storage'), $imgName);
            } 
        }else{
            $filePath = public_path('storage/' . $imgName);

            if (!File::exists($filePath)) {
                $image->move(public_path('storage/imgusers'), $imgName);
            }
        }
        $khachhang->update([
            'name' => $request->name,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => $request->password,
            'address' => $request->address,
            'img' => $imgName,
            'role' => $request->role,
            'statu' => $request->statu,
        ]);
        if($khachhang){
            return redirect()->route('qlkhachhang.index');
        }else{
            echo "Không thành công";
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $khachhang)//name tham số truyền vào phải trùng với tên tham số trong route list
    {
        //
        $khachhang->delete();
        return redirect()->route('qlkhachhang.index');
    }
    public function find(Request $request){
        if(isset($request->name)){
        $result = User::where('name','like',$request->name)->get();
        return view('usermanager.qluser',compact('result'));
        }
    }
}
