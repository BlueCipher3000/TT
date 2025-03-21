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
        <h2 class="mb-4">Sửa thông tin sản phẩm</h2>
        <form action="{{route('product.update',$product)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" name="name" value="{{$product->name}}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Giá</label>
                <input type="number" class="form-control" name="price" value="{{$product->price}}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Giảm giá (%)</label>
                <input type="number" class="form-control" name="sale" value="{{$product->sale}}">
            </div>
            <div class="mb-3">
                <label class="form-label">Sản phẩm hot</label>
                <select class="form-control" name="hot">
                    <option value="0" {{$product->hot == 0 ? 'Selected':''}}>Không</option>
                    <option value="1" {{$product->hot == 1 ? 'Selected':''}}>Có</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <input type="text" class="form-control" name="description" value="{{$product->description}}">
            </div>
            <div class="mb-3">
                <label class="form-label">Hình ảnh</label>
                <input type="file" class="form-control" name="img" accept="image/*" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nội dung</label>
                <textarea class="form-control" name="content" rows="4">{{$product->content}}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <select class="form-control" name="status">
                    <option value="0" {{$product->status == 0 ? 'Selected':''}}>Ẩn</option>
                    <option value="1" {{$product->status == 1 ? 'Selected':''}}>Hiển thị</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Số lượng bán ra</label>
                <input type="number" class="form-control" name="toyal_pay" value="{{$product->toyal_pay}}">
            </div>
            <div class="mb-3">
                <label class="form-label">Số lượng đánh giá</label>
                <input type="number" class="form-control" name="total_rating" value="{{$product->total_rating}}">
            </div>
            <div class="mb-3">
                <label class="form-label">Tổng số sao</label>
                <input type="number" class="form-control" name="total_stars" value="{{$product->total_stars}}">
            </div>
            <div class="mb-3">
                <label class="form-label">Danh mục</label>
                <select class="form-control" name="category_id">
                    @foreach ($result as $value)
                    <option value="{{$value->id}}" {{$product->category_id == $value->id ? 'Selected':''}}>{{$value->name}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Sửa</button>
                <a href="{{route('qlsanpham.index')}}" class="btn btn-secondary">Quay lại</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
