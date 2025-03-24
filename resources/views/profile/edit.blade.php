<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa hồ sơ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h2>Sửa hồ sơ</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="imge" class="form-label">Ảnh đại diện</label>
                <input type="file" name="img" id="img" class="form-control">
                @if($user->img)
                    <img src="{{ asset('storage/imgusers/' . $user->img) }}" class="mt-2 rounded-circle" width="100">
                @endif
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Họ và tên</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">Giới tính</label>
                <select name="gender" id="gender" class="form-select">
                    <option value="0" {{ $user->gender === 0 ? 'selected' : ''}}>Nam</option>
                    <option value="1" {{ $user->gender === 1 ? 'selected' : ''}}>Nữ</option>
                    <option value="" {{ $user->gender === null ? 'selected' : ''}}>Khác</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                <input type="password" name="current_password" id="current_password" class="form-control">
            </div>

            <div class="mb-3">
                <label for="new_password" class="form-label">Mật khẩu mới</label>
                <input type="password" name="new_password" id="new_password" class="form-control">
            </div>

            <div class="mb-3">
                <label for="confirm_password" class="form-label">Xác nhận mật khẩu mới</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Lưu</button>
            <a class="btn btn-primary" href="{{ route('admin.quantri') }}">Quay lại</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
