@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Pengiriman</h1>

    <!-- Form -->
    <div class="card shadow mb-4" style="max-width: 600px; margin: 0 auto;">
        <div class="card-body">
            <form action="{{ route('shipping.store') }}" method="POST">
                @csrf

                <!-- Order -->
                <div class="form-group">
                    <label for="order_id">Order</label>
                    <select name="order_id" id="order_id" class="form-control" required onchange="updateShippingFee()">
                        <option value="" data-fee="0">Pilih Order</option>
                        @foreach ($orders as $order)
                        <option value="{{ $order->id }}" data-fee="{{ $order->shipping_fee }}">
                            ID: {{ $order->id }} - {{ $order->address }} (Subtotal: Rp{{ number_format($order->subtotal, 2, ',', '.') }})
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Metode Pengiriman -->
                <div class="form-group">
                    <label for="method">Metode Pengiriman</label>
                    <input type="text" class="form-control" id="method" name="method" required style="max-width: 400px;">
                </div>

                <!-- Nomor Resi -->
                <div class="form-group">
                    <label for="tracking_number">Nomor Resi</label>
                    <input type="text" class="form-control" id="tracking_number" name="tracking_number" style="max-width: 400px;">
                </div>

                <!-- Tanggal Dikirim -->
                <div class="form-group">
                    <label for="sent_at">Tanggal Dikirim</label>
                    <input type="datetime-local" class="form-control" id="sent_at" name="sent_at" style="max-width: 400px;">
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('shipping.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
