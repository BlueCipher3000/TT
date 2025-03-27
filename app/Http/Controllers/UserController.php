<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::orderBy('id', 'ASC')->paginate(10);
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() //trả về view thêm mới khách hàng
    {
        $result = User::all();
        return view('user.add', compact('result'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) //thêm khách hàng vào database
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'name' => 'required|string|max:255',
            'gender' => 'nullable|in:0,1',
            'password' => 'required|min:8',
            'privilege' => 'required|integer|in:1,2', // Ensure valid privileges
            'status' => 'required|boolean',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],[
            'username.unique' => 'Tên đăng nhập đã tồn tại. Vui lòng chọn tên khác.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'img.image' => 'Tệp tải lên phải là hình ảnh.',
            'img.mimes' => 'Ảnh chỉ được phép có định dạng: jpeg, png, jpg, gif.',
        ]);
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
            if ($image) {
                $filePath = public_path('storage/imgusers');
                if (!File::exists($filePath)) {
                    File::makeDirectory($filePath, 0755, true, true);
                }
                $image->move($filePath, $imgName);
            }

            return redirect()->route('user.index')->with('success', 'Thêm user mới thành công');
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
        if (!Gate::allows('manage-users', $user)) {
            return redirect()->route('user.index')->with('error', 'Bạn không thể chỉnh sửa tài khoản này.');
        }
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if (!Gate::allows('manage-users', $user)) {
            return redirect()->route('user.index')->with('error', 'Bạn không thể cập nhật tài khoản này.');
        }
        // Validate input data
        $request->validate([
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'name' => 'required|string|max:255',
            'gender' => 'nullable|in:0,1',
            'password' => 'nullable|min:8', // Optional but must be 8+ chars
            'privilege' => 'required|integer|in:1,2',
            'status' => 'required|boolean',
            'img' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ],[
            'username.unique' => 'Tên đăng nhập đã tồn tại. Vui lòng chọn tên khác.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'img.image' => 'Tệp tải lên phải là hình ảnh.',
            'img.mimes' => 'Ảnh chỉ được phép có định dạng: jpeg, png, jpg, gif.',
        ]);

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
        if ($request->filled('password')) {
            $user->password = $request->password; // No hashing for now
        }
        $gender = $request->gender !== "" ? (int) $request->gender : null;
        // Update user data (keeping old image if no new one is uploaded)
        $user->update([
            'username' => $request->username,
            'name' => $request->name,
            'gender' => $gender,
            'password' => $user->password,
            'img' => $user->img, // Ensure we keep the old image if no new one is uploaded
            'privilege' => $request->privilege,
            'status' => $request->status,
        ]);
        if ($user) {
            return redirect()->route('user.index')->with('success', 'Cập nhật user thành công');
        }
        else {
            return back()->with('error', 'Cập nhật user thất bại');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user) //name tham số truyền vào phải trùng với tên tham số trong route list
    {
        if (!Gate::allows('manage-users', $user)) {
            return redirect()->route('user.index')->with('error', 'Bạn không có quyền xóa user này');
        }

        $user->delete();
        return redirect()->route('user.index')->with('success', 'Xóa user thành công');
    }
    public function find(Request $request)
    {
        if (isset($request->name)) {
            $users = User::where('name', 'like', $request->name)->get();
            return view('user.index', compact('users'));
        }
    }

    public function editProfile()
    {
        return view('profile.edit', ['user' => auth()->user()]);
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(auth()->id());
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'nullable|in:0,1',
            'img' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'current_password' => ['nullable', 'required_with:new_password', function ($attribute, $value, $fail) use ($user) {
                if ($value !== $user->password) {
                    $fail('Mật khẩu hiện tại không đúng.');
                }
            }],
            'new_password' => 'nullable|min:8|different:current_password',
            'confirm_password' => 'nullable|same:new_password'
        ]);

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
        if ($request->filled('new_password')) {
            $user->password = $request->new_password; // No hashing for now
        }

        $user->update([
            'name' => $request->name,
            'gender' => $request->gender !== "" ? (int) $request->gender : null,
            'password' => $user->password,
            'img' => $user->img,
        ]);

        return redirect()->route('profile.edit')->with('success', 'Cập nhật thông tin cá nhân thành công');
    }
}
