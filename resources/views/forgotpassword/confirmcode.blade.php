<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhập Mã Xác Nhận</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }

        .code-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        .code-container h2 {
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            text-align: center;
            font-size: 18px;
            letter-spacing: 3px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            margin-top: 10px;
            font-size: 14px;
        }

        .success {
            color: green;
            margin-top: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="code-container">
        <h2>Nhập Mã Xác Nhận</h2>
        
        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <form action="{{route('forgotpassword.check_confirmation_code',$user)}}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" name="code" placeholder="Nhập mã" required>
            </div>
            <button type="submit">Xác nhận</button>
        </form>
    </div>

</body>
</html>
