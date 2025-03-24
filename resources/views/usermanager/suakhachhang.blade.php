<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Người Dùng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 320px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h2 {
            text-align: center;
            width: 100%;
        }
        label {
            font-weight: bold;
            display: block;
            width: 100%;
            margin-top: 10px;
        }
        input, select, button {
            width: calc(100% - 20px);
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            display: block;
        }
        div {
            display: flex;
            justify-content: space-between;
            flex-direction: column;
        }

        .btn {
            background: #28a745;
            color: #fff;
            border: none;
            padding: 10px;
            width: 100%;
            cursor: pointer;
            border-radius: 4px;
        }
        .btn:hover {
            background: #218838;
        }

        a {
            text-decoration: none;
            margin-top: 0.5rem;
            text-align: center;
            font-size: 13.3333px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Sửa Người Dùng</h2>
        <form action="{{route('user.update',$user)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="username">Tên Đăng Nhập:</label>
            <input type="text" id="username" name="username" value="{{$user->username}}" required>

            <label for="name">Họ và Tên:</label>
            <input type="text" id="name" name="name" value="{{$user->name}}" required>

            <label for="gender">Giới Tính:</label>
            <select id="gender" name="gender">
                <option value="0" {{ $user->gender === 0 ? 'selected' : ''}}>Nam</option>
                <option value="1" {{ $user->gender === 1 ? 'selected' : ''}}>Nữ</option>
                <option value="" {{ $user->gender === null ? 'selected' : ''}}>Khác</option>
            </select>

            {{-- <label for="birthday">Ngày Sinh:</label>
            <input type="date" id="birthday" name="birthday" value="{{$khachhang->birthday}}" required>

            <label for="phone">Số Điện Thoại:</label>
            <input type="text" id="phone" name="phone" value="{{$khachhang->phone}}" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{$khachhang->email}}" required> --}}

            <label for="password">Mật Khẩu:</label>
            <input type="password" id="password" name="password" value="{{$user->password}}" required>

            {{-- <label for="address">Địa Chỉ:</label>
            <input type="text" id="address" name="address" value="{{$khachhang->address}}"> --}}

            <label for="img">Hình Ảnh:</label>
            <input type="file" id="img" name="img">

            <label for="privilege">Vai Trò:</label>
            <select id="privilege" name="privilege">
                <option value="1" {{ $user->privilege === 1 ? 'selected' : ''}}>Quản trị viên</option>
                <option value="2" {{ $user->privilege === 2 ? 'selected' : ''}}>Người kiểm duyệt</option>
            </select>

            <label for="status">Trạng Thái:</label>
            <select id="status" name="status">
                <option value="1">Hoạt Động</option>
                <option value="0">Khóa</option>
            </select>
            <div>
                <a class="btn" href="{{route('qlkhachhang.index')}}">Quay lại</a>
                <button class="btn" type="submit">Đồng ý</button>
            </div>
        </form>
    </div>
</body>
</html>
