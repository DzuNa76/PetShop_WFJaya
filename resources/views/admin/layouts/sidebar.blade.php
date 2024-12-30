<!-- resources/views/partials/sidebar.blade.php -->

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.indexadmin') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-fw fa-paw"></i>
        </div>
        <div class="sidebar-brand-text mx-3">WF Jaya</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.indexadmin') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Manajemen Produk
    </div>

    <!-- Nav Item - Kategori -->
    <li class="nav-item ">
        <a class="nav-link" href="{{ route('kategori.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Kategori</span></a>
    </li>

    <!-- Nav Item - Hewan -->
    <li class="nav-item ">
        <a class="nav-link" href="{{ route('hewan.index') }}">
            <i class="fas fa-fw fa-paw"></i>
            <span>Hewan</span></a>
    </li>

    <!-- Nav Item - Produk -->
    <li class="nav-item ">
        <a class="nav-link" href="{{ route('produk.index') }}">
            <i class="fas fa-fw fa-box"></i>
            <span>Produk</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Heading -->
    <div class="sidebar-heading">
        Transaksi
    </div>

    <!-- Nav Item - Order Masuk -->
    <li class="nav-item ">
        <a class="nav-link" href="{{ route('order.index') }}">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Order Masuk</span></a>
    </li>

    <!-- Nav Item - Pembayaran -->
    {{-- <li class="nav-item ">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-money-check-alt"></i>
            <span>Pembayaran</span></a>
    </li> --}}

    <!-- Nav Item - Pengiriman -->
    <li class="nav-item ">
        <a class="nav-link" href="{{ route('shipping.index') }}">
            <i class="fas fa-fw fa-truck"></i>
            <span>Pengiriman</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Heading -->
    <div class="sidebar-heading">
        User
    </div>

    <!-- Nav Item - Customer -->
    <li class="nav-item ">
        <a class="nav-link" href="{{ route('customer.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Customer</span></a>
    </li>

    <!-- Nav Item - Admin -->
    <li class="nav-item ">
        <a class="nav-link" href="{{ route('admin.index') }}">
            <i class="fas fa-fw fa-user-cog"></i>
            <span>Admin</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>