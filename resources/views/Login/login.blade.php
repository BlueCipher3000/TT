<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
            position: relative;
        }

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Nút đăng ký góc phải */
        .register-container {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .register-button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .register-button:hover {
            background-color: #0056b3;
        }

        /* Dòng quên mật khẩu */
        .forgot-password {
            text-align: right;
            margin-top: 5px;
        }

        .forgot-password a {
            text-decoration: none;
            color: #007bff;
            font-size: 14px;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Nút đăng ký -->
    <div class="register-container">
        <form action="{{route('register')}}" method="GET">
            <button class="register-button">Đăng ký</button>
        </form>
    </div>

    <div class="login-container">
        <h2>Đăng nhập</h2>
        <form action="{{route('login.index')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="username">Tên đăng nhập:</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" id="password" name="password" required>
                <div class="forgot-password">
                    <a href="{{route('forgotpassword.index')}}">Quên mật khẩu?</a>
                </div>
            </div>
            @if ($errors->has('login'))
            <div style="background-color: #ffebee; /* Nền đỏ nhạt */
    color: #d32f2f; /* Màu chữ đỏ đậm */
    padding: 10px;
    border-radius: 5px;
    text-align: center;
    font-size: 14px;
    font-weight: bold;
    border: 1px solid #d32f2f;
    margin-bottom: 10px;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);">
                {{ $errors->first('login') }}
            </div>
            @endif
            <button>Đăng nhập</button>
        </form>
    </div>
</body>
</html>
