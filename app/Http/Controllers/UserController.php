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
        $users = User::orderBy('id', 'ASC')->paginate(10);
        return view('usermanager.qluser', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() //trả về view thêm mới khách hàng
    {
        $result = User::all();
        return view('usermanager.themkhachhang', compact('result'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) //thêm khách hàng vào database
    {
        // $request->validate([
        //     'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);
        $image = $request->file('img');
        $imgName = $image ? $image->getClientOriginalName() : 'default.png';

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'gender' => $request->gender,
            /* 'birthday' => $request->birthday,
            'phone' => $request->phone,
            'email' => $request->email, */
            'password' => $request->password,
            /* 'address' => $request->address, */
            'img' => $imgName,
            'privilege' => $request->privilege,
            'status' => $request->status,
        ]);
        if ($user) {
            if ($image)
                $image->move(public_path('storage/imgusers'), $imgName);
            return redirect()->route('qlkhachhang.index');
        } else {
            return back()->with('error', 'Thêm user mới thất bại');
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
    public function edit(User $user)
    {
        return view('usermanager.suakhachhang', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validate input data
        /* $request->validate([
            'username' => 'required|string|max:50',
            'name' => 'required|string',
            'gender' => 'nullable|integer',
            'password' => 'nullable|string|min:6', // Password update is optional
            'privilege' => 'required|integer',
            'status' => 'required|integer',
            'img' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048' // Ensure valid image
        ]); */

        // Check if a new image is uploaded
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imgName = time() . '_' . $image->getClientOriginalName(); // Avoid overwriting files

            // Ensure the storage directory exists
            $filePath = public_path('storage/imgusers');
            if (!File::exists($filePath)) {
                File::makeDirectory($filePath, 0755, true, true);
            }

            // Move the uploaded image
            $image->move($filePath, $imgName);

            // Assign new image to user
            $user->img = $imgName;
        }
        $gender = $request->gender !== "" ? (int) $request->gender : null;
        // Update user data (keeping old image if no new one is uploaded)
        $user->update([
            'username' => $request->username,
            'name' => $request->name,
            'gender' => $gender,
            'password' => $request->password, // Hash new password if provided
            'img' => $user->img, // Ensure we keep the old image if no new one is uploaded
            'privilege' => $request->privilege,
            'status' => $request->status,
        ]);

        return redirect()->route('qlkhachhang.index')->with('success', 'User updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user) //name tham số truyền vào phải trùng với tên tham số trong route list
    {
        //
        $user->delete();
        return redirect()->route('qlkhachhang.index');
    }
    public function find(Request $request)
    {
        if (isset($request->name)) {
            $result = User::where('name', 'like', $request->name)->get();
            return view('usermanager.qluser', compact('result'));
        }
    }
}
