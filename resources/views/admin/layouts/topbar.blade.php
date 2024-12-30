<!-- resources/views/partials/topbar.blade.php -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Menampilkan jumlah notifikasi -->
                <span class="badge badge-danger badge-counter">
                    {{ isset($newOrders) && !$newOrders->isEmpty() ? $newOrders->count() : 0 }}
                </span>
            </a>
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Notifikasi Pesanan Baru
                </h6>
                @if(isset($newOrders) && $newOrders->isEmpty())
                    <a class="dropdown-item text-center small text-gray-500">Tidak ada pesanan baru</a>
                @else
                    @foreach($newOrders as $order)
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('orders.show', $order->id) }}">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-box text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</div>
                                <span class="font-weight-bold">Pesanan dari {{ $order->name }}</span>
                            </div>
                        </a>
                    @endforeach
                @endif
                <a class="dropdown-item text-center small text-gray-500" href="{{ route('order.index') }}">Lihat Semua Pesanan</a>
            </div>            
        </li>
               

        <div class="topbar-divider d-none d-sm-block"></div>

        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->guard('admin')->user()->name ?? 'Admin' }}</span>
                {{-- <img class="img-profile rounded-circle" src=""> --}}
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('admin.edit', $admin->id) }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
