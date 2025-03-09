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
        button {
            background-color: #28a745;
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin-top: 15px;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Thêm Người Dùng</h2>
        <form action="{{route('khachhang.update',$khachhang)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="name">Họ và Tên:</label>
            <input type="text" id="name" name="name" value="{{$khachhang->name}}" required>

            <label for="gender">Giới Tính:</label>
            <select id="gender" name="gender">
                <option value="1" {{$khachhang->gender == 1 ? 'Selected' : ''}}>Nam</option>
                <option value="2" {{$khachhang->gender == 2 ? 'Selected' : ''}}>Nữ</option>
                <option value="0" {{$khachhang->gender == 0 ? 'Selected' : ''}}>Khác</option>
            </select>

            <label for="birthday">Ngày Sinh:</label>
            <input type="date" id="birthday" name="birthday" value="{{$khachhang->birthday}}" required>

            <label for="phone">Số Điện Thoại:</label>
            <input type="text" id="phone" name="phone" value="{{$khachhang->phone}}" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{$khachhang->email}}" required>

            <label for="passw">Mật Khẩu:</label>
            <input type="password" id="password" name="password" value="{{$khachhang->password}}" required>

            <label for="address">Địa Chỉ:</label>
            <input type="text" id="address" name="address" value="{{$khachhang->address}}">

            <label for="img">Hình Ảnh:</label>
            <input type="file" id="img" name="img">

            <label for="role">Vai Trò:</label>
            <select id="role" name="role">
                <option value="1" {{$khachhang->role == 1 ? 'Selected':''}}>Admin</option>
                <option value="0" {{$khachhang->role == 0 ? 'Selected':''}}>User</option>
            </select>

            <label for="statu">Trạng Thái:</label>
            <select id="statu" name="statu">
                <option value="1" {{$khachhang->statu == 1 ? 'Selected':''}}>Hoạt Động</option>
                <option value="0" {{$khachhang->statu == 0 ? 'Selected':''}}>Khóa</option>
            </select>

            <button>Đồng ý</button>
        </form>
    </div>
</body>
</html>
