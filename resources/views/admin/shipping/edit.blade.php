@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Edit Pengiriman</h1>

    <!-- Form -->
    <div class="card shadow mb-4" style="max-width: 600px; margin: 0 auto;">
        <div class="card-body">
            <form action="{{ route('shipping.update', $shipping->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Order -->
                <div class="form-group">
                    <label for="order_id">Order</label>
                    <select name="order_id" id="order_id" class="form-control" required>
                        <option value="">Pilih Order</option>
                        @foreach ($orders as $order)
                        <option value="{{ $order->id }}" data-fee="{{ $order->shipping_fee }}" {{ $shipping->order_id == $order->id ? 'selected' : '' }}>
                            ID: {{ $order->id }} - {{ $order->address }} (Subtotal: Rp{{ number_format($order->subtotal, 2, ',', '.') }})
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Metode Pengiriman -->
                <div class="form-group">
                    <label for="method">Metode Pengiriman</label>
                    <input type="text" class="form-control" id="method" name="method" value="{{ $shipping->method }}" required style="max-width: 400px;">
                </div>

                <!-- Nomor Resi -->
                <div class="form-group">
                    <label for="tracking_number">Nomor Resi</label>
                    <input type="text" class="form-control" id="tracking_number" name="tracking_number" value="{{ $shipping->tracking_number }}" style="max-width: 400px;">
                </div>

                <!-- Tanggal Dikirim -->
                <div class="form-group">
                    <label for="sent_at">Tanggal Dikirim</label>
                    <input type="datetime-local" class="form-control" id="sent_at" name="sent_at" value="{{ $shipping->sent_at ? $shipping->sent_at->format('Y-m-d\TH:i') : '' }}" style="max-width: 400px;">
                    {{-- <input type="datetime-local" class="form-control" id="sent_at" name="sent_at" value="{{ $shipping->sent_at ? $shipping->sent_at->format('Y-m-d\TH:i') : '' }}" style="max-width: 400px;"> --}}
                    {{-- <input type="datetime-local" class="form-control" id="sent_at" name="sent_at" value="{{ $shipping->sent_at ? \Carbon\Carbon::parse($shipping->sent_at)->format('Y-m-d\TH:i') : '' }}" style="max-width: 400px;"> --}}

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
