@extends('Layout.layout')
@section('namebuttonadd')
<form action="{{route('category.find')}}" method="GET">
    @csrf
    <input type="text" name="name" placeholder="Nhập tên danh mục" required>
    <button class="btn-search">Tìm kiếm</button>
</form>
<form action="{{route('category.create')}}" method="GET">
    <button class="btn-green">+ Thêm danh mục mới</button>
</form>
@endsection
@section('content')
    <thead>
                <tr>
                    <th>Tên</th>
                    <th>Mô tả</th>
                    <th>Ảnh</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($result as $value)
                <tr>
                    <td>{{$value->name}}</td>
                    <td>{{$value->description}}</td>
                    <td><img style="max-width: 150px;height: auto;display: block;margin: auto;"src="{{asset('storage/imgcategories/'.$value->img)}}" alt=""></td>
                    <td>{{$value->status ? "Hoạt động" : "Không hoạt động"}}</td>
                    <td>
                        <form action="{{route('category.edit',$value)}}" method="GET">
                            @csrf
                            <button class="btn-blue">Sửa</button>
                        </form>
                        <form action="{{route('category.destroy', $value)}}" method="POST" onsubmit="return confirmDelete(event)">
                            @csrf
                            @method('DELETE')
                            <button style="margin-top: 5px" class="btn-red">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
@endsection
