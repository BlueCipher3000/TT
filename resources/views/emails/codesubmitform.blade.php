<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác Nhận Mã Token</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; text-align: center;">
    <div style="max-width: 500px; background: #fff; margin: auto; padding: 20px; border-radius: 10px; box-shadow: 2px 2px 10px rgba(0,0,0,0.1);">
        <h2 style="color: #007bff;">Xác Nhận Mã Token</h2>
        <p style="font-size: 16px; color: #333;">Xin chào,</p>
        <p style="font-size: 16px; color: #333;">Mã xác nhận của bạn là:</p>
        <p style="font-size: 24px; font-weight: bold; color: #28a745; letter-spacing: 2px;">{{$user->token}}</p>
        <p style="font-size: 14px; color: #666;">Vui lòng sử dụng mã này để xác thực tài khoản của bạn.</p>
        <hr style="border: none; height: 1px; background-color: #ddd; margin: 20px 0;">
        <p style="font-size: 12px; color: #999;">Nếu bạn không yêu cầu mã này, vui lòng bỏ qua email này.</p>
    </div>
</body>
</html>