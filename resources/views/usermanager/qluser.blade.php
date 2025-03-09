@extends('layout.layout')
@section('namebuttonadd')
<form action="{{route('qlkhachhang.find')}}" method="GET">
    @csrf
    <input type="text" name="name" placeholder="Nhập tên đăng nhập của người dùng" required>
    <button class="btn-search">Tìm kiếm</button>
</form>
<form action="{{route('themkhachhang')}}" method="GET">
    <button class="btn-green">+ Thêm khách hàng mới</button>
</form>
@endsection
@section('content')
<thead>
    <tr>
        <th>Tên đăng nhập</th>
        <th>Giới tính</th>
        <th>Ngày sinh</th>
        <th>SDT</th>
        <th>Email</th>
        <th>Password</th>
        <th>Địa chỉ</th>
        <th>Ảnh đại diện</th>
        <th>Loại</th>
        <th>Trạng thái</th>
        <th></th>
    </tr>
</thead>
<tbody>
    @foreach ( $result as $value)
    <tr>
        <td>{{$value->name}}</td>
        <td>
            @if ($value->gender == 1)
            {{"Nam"}}
        @elseif($value->gender == 2)
            {{"Nữ"}}
        @else
            {{"Khác"}}
        @endif
        </td>
        <td>{{$value->birthday}}</td>
        <td>{{$value->phone}}</td>
        <td>{{$value->email}}</td>
        <td>{{$value->password}}</td>
        <td>{{$value->address}}</td>
        <td>
            @if ($value->role == 1)
            <img height="100px" width="100px" style="border-radius: 50%;" src="{{ asset('storage/'.$value->img)}}" alt="">
            @else
            <img height="100px" width="100px" style="border-radius: 50%;" src="{{ asset('storage/imgusers/'.$value->img)}}" alt="">
            @endif
        </td>
        <td>
            @if ($value->role == 1)
            {{"Amin"}}
        @else
            {{"Khách hàng"}}
        @endif
        </td>
        <td>
            @if ($value->statu == 1)
                {{"Hoạt động"}}
            @else
                {{"Khóa"}}
            @endif
        </td>
        <td>
            <form action="{{route('khachhang.edit',$value)}}" method="GET">
                @csrf
                <button class="btn-blue">Edit</button> 
            </form>
            <form action="{{route('khachhang.destroy', $value)}}" method="POST">
                @csrf
                @method('DELETE')
                <button style="margin-top: 5px" class="btn-red">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>
@endsection