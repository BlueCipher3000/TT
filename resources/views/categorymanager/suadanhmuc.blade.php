<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Nhập Danh Mục</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        label {
            font-weight: bold;
        }
        input, textarea, select {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
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
        <h2>Nhập Danh Mục</h2>
        <form action="{{route('category.update',$category)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="name">Tên danh mục:</label>
            <input type="text" id="name" name="name" value="{{$category->name}}" required>

            <label for="description">Mô tả:</label>
            <textarea id="description" name="description" >{{$category->describe}}</textarea>

            <label for="img">Hình Ảnh:</label>
            <input type="file" id="img" name="img">

            <label for="status">Trạng thái:</label>
            <select id="status" name="status">
                <option value="1" {{$category->status == 1 ? 'Selected':''}}>Hoạt động</option>
                <option value="0" {{$category->status == 0 ? 'Selected':''}}>>Không hoạt động</option>
            </select>
            <div>
                <button class="btn" type="submit">Lưu</button>
                <a class="btn" href="{{route('qldanhmuc.index')}}">Quay lại</a>
            </div>
        </form>
    </div>
</body>
</html>
