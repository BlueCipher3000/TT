@extends('Layout.layout')
@section('namebuttonadd')
<form action="{{route('product.find')}}" method="GET">
    @csrf
    <input type="text" name="name" placeholder="Nhập tên sản phẩm" required>
    <button class="btn-search">Tìm kiếm</button>
</form>
<form action="{{route('product.create')}}" method="GET">
    <button class="btn-green">+ Thêm sản phẩm mới</button>
</form>
@endsection
@section('content')
<thead>
    <tr>
        <th>Tên sản phẩm</th>
        <th>Giá</th>
        <th>Giảm giá</th>
        <th>Sản phẩm hot</th>
        <th>Mô tả</th>
        <th>Hình ảnh</th>
        <th>Nội dung</th>
        <th>Trạng thái</th>
        <th>Số lượng bán</th>
        <th>Số lượng đánh giá</th>
        <th>Tổng số sao</th>
        <th>Danh mục</th>
        <th>Hành động</th>
    </tr>
</thead>
<tbody>
        @foreach ($result as $value)
    <tr>
        <td>{{$value->name}}</td>
        <td>{{$value->price}} đ</td>
        <td>{{$value->sale}}%</td>
        <td>{{$value->hot == 0 ? 'Không' : 'Có'}}</td>
        <td>{{$value->description}}</td>
        <td><img src="{{asset('storage/imgproducts/'.$value->img)}}" alt="Hình ảnh"
            style="max-width: 150px;height: auto;display: block;margin: auto;"></td>
        <td>{{$value->content}}</td>
        <td>{{$value->status == 0 ? 'Ẩn' : 'Hiển thị'}}</td>
        <td>{{$value->total_pay}}</td>
        <td>{{$value->total_rating}}</td>
        <td>{{$value->total_stars}}</td>
        <td>{{$value->ReferencesCategory->name}}</td>
        <td>
            <form action="{{route('product.edit',$value)}}" method="GET">
                @csrf
                <button class="btn-blue">Edit</button>
            </form>
            <form action="{{route('product.destroy', $value)}}" method="POST">
                @csrf
                @method('DELETE')
                <button style="margin-top: 5px" class="btn-red">Delete</button>
            </form>
        </td>
    </tr>
        @endforeach

</tbody>
@endsection
