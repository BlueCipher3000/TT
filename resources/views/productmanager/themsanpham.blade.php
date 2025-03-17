<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhập thông tin sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Nhập thông tin sản phẩm</h2>
        <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Giá</label>
                <input type="number" class="form-control" name="price" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Giảm giá (%)</label>
                <input type="number" class="form-control" name="sale">
            </div>
            <div class="mb-3">
                <label class="form-label">Sản phẩm hot</label>
                <select class="form-control" name="hot">
                    <option value="0">Không</option>
                    <option value="1">Có</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <input type="text" class="form-control" name="description">
            </div>
            <div class="mb-3">
                <label class="form-label">Hình ảnh</label>
                <input type="file" class="form-control" name="img" accept="image/*" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nội dung</label>
                <textarea class="form-control" name="content" rows="4"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <select class="form-control" name="status">
                    <option value="0">Ẩn</option>
                    <option value="1">Hiển thị</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Số lượng bán ra</label>
                <input type="number" class="form-control" name="total_pay">
            </div>
            <div class="mb-3">
                <label class="form-label">Số lượng đánh giá</label>
                <input type="number" class="form-control" name="total_rating">
            </div>
            <div class="mb-3">
                <label class="form-label">Tổng số sao</label>
                <input type="number" class="form-control" name="total_stars">
            </div>
            <div class="mb-3">
                <label class="form-label">Danh mục</label>
                <select class="form-control" name="category_id">
                    @foreach ($result as $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Lưu sản phẩm</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
