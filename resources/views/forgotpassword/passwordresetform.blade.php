<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lại mật khẩu</title>
    <style>
        /* Căn giữa form */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 350px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border 0.3s;
        }

        input:focus {
            border: 1px solid #007bff;
            outline: none;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .alert {
            background-color: #ffebee;
            color: #d32f2f;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <!-- Hiển thị thông báo lỗi nếu có -->
        @if (session('error'))
            <div class="alert">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('forgotpassword.resetpassword', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="password">Mật khẩu mới</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Xác nhận mật khẩu</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
            </div>

            <button type="submit" class="btn">Đặt lại mật khẩu</button>
        </form>
    </div>

</body>
</html>
