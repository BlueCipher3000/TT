<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            display: flex;
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: white;
            margin: 0;
            transition: all 0.3s ease;
        }
        .sidebar {
            width: 250px;
            background: #1E1E1E;
            padding: 20px;
            height: 100vh;
            position: fixed;
            transition: all 0.3s ease;
        }
        .profile {
            text-align: center;
            margin-bottom: 20px;
        }
        .profile img {
            width: 60px;
            border-radius: 50%;
            transition: transform 0.3s ease;
        }
        .profile img:hover {
            transform: scale(1.1);
        }
        ul {
            list-style: none;
            padding: 0;
        }
        ul li {
            height: 40px;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        ul li:hover {
            background: #333;
        }
        .main-content {
            margin-left: 270px;
            padding: 20px;
            width: calc(100% - 270px);
            transition: all 0.3s ease;
        }
        .top-bar {
            display: flex;
            justify-content: end;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        .top-bar input {
            width: 300px;
            padding: 8px;
            margin-right: 10px;
            border-radius: 5px;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-green {
            margin-left: 20px;
            background: green;
            color: white;
            padding: 8px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .btn-green:hover {
            background: #0f0;
        }
        .btn-search {
            background: blue;
            color: white;
            padding: 8px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .btn-search:hover {
            background: #00f;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        th, td {
            padding: 10px;
            border: 1px solid #333;
            text-align: left;
            transition: all 0.3s ease;
        }
        a{
            font-family: sans-serif;
            color: rgb(91, 24, 122);
            text-decoration: none;
        }
        .active{
            color: white;
        }
        .btn-blue, .btn-red {
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .btn-blue { background: blue; color: white; }
        .btn-blue:hover { background: #00f; }
        .btn-red { background: red; color: white; }
        .btn-red:hover { background: #f00; }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }
            .main-content {
                margin-left: 210px;
                width: calc(100% - 210px);
            }
        }
        @media (max-width: 480px) {
            .sidebar {
                width: 100px;
                padding: 10px;
            }
            .main-content {
                margin-left: 110px;
                width: calc(100% - 110px);
            }
            .top-bar {
                flex-direction: column;
            }
            .top-bar input {
                margin-bottom: 10px;
            }
            table {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>CORONA</h2>
        <div class="profile">
            <img src="{{asset('storage/pngtree-round-kid-avatar-boy-face-picture-image_8005285.png')}}" alt="Avatar">
            <p>Henry Klein</p>
            <span>Gold Member</span>
        </div>
        <ul>
            <li><a style="height: 100%; width: 100%; margin-top: 20px;" class="{{request()->is('qlkhachhang')|| request()->is('qlkhachhang/*')  ? 'active':''}}" href="{{route('qlkhachhang.index')}}">Quản lý khách hàng</a></li>
            <li><a style="height: 100%; width: 100%; margin-top: 20px;" class="{{request()->is('qldanhmuc') || request()->is('qldanhmuc/*') ? 'active':''}}" href="{{route('qldanhmuc.index')}}">Quản lý danh mục</a></li>
            <li><a style="height: 100%; width: 100%; margin-top: 20px;" class="{{request()->is('qlsanpham') || request()->is('qlsanpham/*') ? 'active':''}}" href="{{route('qlsanpham.index')}}">Quản lý sản phẩm</a></li>
            <li><a style="height: 100%; width: 100%; margin-top: 20px;" class="{{request()->is()}}" href="">Tables</a></li>
            <li><a style="height: 100%; width: 100%; margin-top: 20px;" class="{{request()->is()}}" href="">Charts</a></li>
            <li><a style="height: 100%; width: 100%; margin-top: 20px;" class="{{request()->is()}}" href="">Icons</a></li>
            <li><a style="height: 100%; width: 100%; margin-top: 20px;" class="{{request()->is()}}" href="">User Pages</a></li>
            <li><a style="height: 100%; width: 100%; margin-top: 20px;" class="{{request()->is()}}" href="">Documentation</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="top-bar">
            @yield('namebuttonadd')
        </div>
        <h2>Project Overview</h2>
        <table>
            @yield('content')
            {{-- <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>10</td>
                    <td>Kyra Ebert</td>
                    <td>Hiển thị</td>
                    <td>5</td>
                    <td>12/10/2024</td>
                    <td><button class="btn-blue">Edit</button> <button class="btn-red">Delete</button></td>
                </tr>
            </tbody> --}}
        </table>
    </div>
</body>
</html>