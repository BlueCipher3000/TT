<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }

        .reset-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }

        .reset-container h2 {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
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

        .btn-submit {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }

        .message {
            margin-top: 10px;
            font-size: 14px;
        }

        .message.success {
            color: #28a745;
        }

        .message.error {
            color: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <h2>Quên mật khẩu</h2>
        @if (session('status'))
            <p class="message success">{{ session('status') }}</p>
        @endif

        @if ($errors->any())
            <p class="message error">{{ $errors->first() }}</p>
        @endif

        <form action="{{route('forgotpassword.submit_token_to_email')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Nhập địa chỉ email của bạn:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <button type="submit" class="btn-submit">Gửi yêu cầu</button>
        </form>
    </div>
</body>
</html>
