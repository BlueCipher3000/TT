@extends('Layout.layout')
@section('namebuttonadd')
<form action="{{route('qlkhachhang.find')}}" method="GET">
    @csrf
    <input type="text" name="name" placeholder="Nhập tên đăng nhập của người dùng" required>
    <button class="btn-search">Tìm kiếm</button>
</form>
<form action="{{route('themkhachhang')}}" method="GET">
    <button class="btn-green">+ Thêm user mới</button>
</form>
@endsection
@section('content')
    <thead>
        <tr>
            <th>ID</th>
            <th>Họ và tên</th>
            <th>Ảnh</th>
            <th>Vai trò</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>
                    <img src="{{ asset('storage/imgusers/' . $user->img) }}"
                         alt="Avatar"
                         width="40"
                         height="40"
                         object-fit="fill"
                         style="border-radius: 50%;">
                </td>
                <td>
                    @if ($user->privilege == 0)
                        ROOT
                    @elseif ($user->privilege == 1)
                        Quản trị viên
                    @else
                        Người kiểm duyệt
                    @endif
                </td>
                @unless($user->privilege == 0)
                <td>
                    <a href="{{ route('user.edit', $user) }}" class="btn-blue">Sửa</a>
                    <form action="{{ route('user.destroy', $user) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-red">Xóa</button>
                    </form>
                </td>
                @endunless
            </tr>
        @endforeach
    </tbody>
@endsection
