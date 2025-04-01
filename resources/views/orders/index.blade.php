@extends('Layout.layout')

@section('content')
    <thead>
        <tr>
            <th>ID</th>
            <th>Ngày đặt</th>
            <th>Chi tiết</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <ul>
                        @foreach ($order->cartItems as $item)
                            <li>{{ $item->product_name }} (x{{ $item->quantity }})</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ number_format($order->total_price, 0, ',', '.') }}₫</td>
                <td>
                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="status" onchange="this.form.submit()">
                            <option value="0" {{ $order->status == '0' ? 'selected' : '' }}>Chờ xử lý</option>
                            <option value="1" {{ $order->status == '1' ? 'selected' : '' }}>Đang xử lý</option>
                            <option value="2" {{ $order->status == '2' ? 'selected' : '' }}>Hoàn tất</option>
                        </select>
                    </form>
                </td>
                <td>
                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('Xóa đơn hàng này?')">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
@endsection
