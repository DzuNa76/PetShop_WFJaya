@extends('admin.layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Pengiriman</h1>
    <p class="mb-4">Data Pengiriman</p>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('shipping.create') }}" class="btn btn-success">Tambah Pengiriman</a>
        <a href="{{ route('shipping.cetak') }}" class="btn btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Cetak</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Pengiriman</th>
                            <th>ID Order</th>
                            <th>ID User</th>
                            <th>Alamat Penerima</th>
                            <th>Metode Pengiriman</th>
                            <th>Biaya Pengiriman</th>
                            <th>Nomer Resi</th>
                            <th>Tanggal Dikirim</th>
                            <th>Tanggal Diterima</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shippings as $shipping)
                        <tr>
                            <td>{{ $shipping->id }}</td>
                            <td>{{ $shipping->order_id }}</td>
                            <td>{{ $shipping->user_id }}</td>
                            <td>{{ $shipping->address }}</td>
                            <td>{{ $shipping->method }}</td>
                            <td>{{ number_format($shipping->shipping_fee, 2, ',', '.') }}</td>
                            <td>{{ $shipping->tracking_number }}</td>
                            <td>{{ $shipping->sent_at }}</td>
                            <td>{{ $shipping->received_at }}</td>
                            <td>
                                <!--  Edit -->
                                <a href="{{ route('shipping.edit', $shipping->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <!--  Hapus -->
                                {{-- <form action="{{ route('shipping.destroy', $shipping->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
