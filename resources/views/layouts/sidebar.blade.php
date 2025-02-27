<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="sidebar-logo">
                    <img src="{{ asset('templates/assets/images/logo/arena_sport.png') }}" alt="Logo" class="w-10 h-auto mx-10">
                </div>
                {{-- <div class="logo">
                    <a href="#"><img src="{{ asset('templates/assets/images/logo/arena_sport.png') }}" alt="Logo"
                            srcset=""></a>
                </div> --}}
                <div class="toggler bg-warning">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item {{ request()->is('admin/dashbord') ? 'active' : '' }}">
                    <a href="/admin/dashboard" class='sidebar-link'>
                        <i class="bi bi-grid-fill" style="color: #080808;"></i>
                        <span class="text-dark">Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->is('admin/booking') ? 'active' : '' }} has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="fa-solid fa-volleyball" style="color: #080808;"></i>
                        <span class="text-dark">Kelola Booking</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="extra-component-avatar.html">Transaksi Booking</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="/admin/lapangan">List Lapangan</a>
                        </li>
                    </ul>
                </li>
                @if (Auth::user()->hasRole('admin'))
                    <li class="sidebar-item {{ request()->is('admin/produk') ? 'active' : '' }} has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="fa-brands fa-shopify" style="color: #080808;"></i>
                            <span class="text-dark">Kelola Produk</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item {{ request()->is('admin/transaksi/produk') ? 'active' : '' }}">
                                <a href="/admin/transaksi/">Transaksi Produk</a>
                            </li>
                            <li class="submenu-item {{ request()->is('admin/produk') ? 'active' : '' }}">
                                <a href="/admin/produk">List Produk</a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (Auth::user()->hasRole('admin'))
                    <li class="sidebar-item {{ request()->is('admin/events') ? 'active' : '' }}  ">
                        <a href="/admin/events" class='sidebar-link'>
                            <i class="fa-solid fa-calendar" style="color: #080808;"></i>
                            <span class="text-dark">Events</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->hasRole('admin'))
                    <li class="sidebar-item {{ request()->is('admin/info') ? 'active' : '' }}  ">
                        <a href="/admin/info" class='sidebar-link'>
                            <i class="fa-solid fa-marker" style="color: #080808;"></i>
                            <span class="text-dark">Informasi</span>
                        </a>
                    </li>
                @endif

                <li class="sidebar-title">Setting</li>
                @if (Auth::user()->hasRole('admin'))
                    <li class="sidebar-item {{ request()->is('admin/slider') ? 'active' : '' }}">
                        <a href="/admin/slider" class='sidebar-link'>
                            <i class="bi bi-image-fill" style="color: #080808;"></i>
                            <span class="text-dark">Slider</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->hasRole('admin'))
                    <li>
                        <a href="#" class='sidebar-link {{ request()->is('admin/user') ? 'active' : '' }}'>
                            <i class="fa-solid fa-users" style="color: #080808;"></i>
                            <span class="text-dark">Kelola User</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item ">
                                <a href="ui-widgets-chatbox.html">User</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="ui-widgets-pricing.html">Patner</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="ui-widgets-todolist.html">Team</a>
                            </li>
                        </ul>
                    </li>
                @endif
                <li class="sidebar-item {{ request()->is('admin/bank') ? 'active' : '' }}  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-cash" style="color: #080808;"></i>
                        <span class="text-dark">Kelola Pembayaran</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="ui-icons-fontawesome.html">Transaksi Pembayaran</a>
                        </li>
                        <li class="submenu-item {{ request()->is('admin/bank') ? 'active' : '' }} ">
                            <a href="/admin/bank">Daftar Bank</a>
                        </li>
                    </ul>
                </li>
                @if (Auth::user()->hasRole('admin'))
                    <li class="sidebar-item {{ request()->is('admin/marquee') ? 'active' : '' }} ">
                        <a href="/admin/marquee" class='sidebar-link'>
                            <i class="fa-solid fa-bookmark" style="color: #080808;"></i>
                            <span class="text-dark">marquee</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->hasRole('admin'))
                    <li class="sidebar-item {{ request()->is('admin/kategori/fasilitas') ? 'active' : '' }}  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="fa-solid fa-list" style="color: #080808;"></i>
                            <span class="text-dark">Kelola Kategori</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item {{ request()->is('admin/kategori/olahraga') ? 'active' : '' }} ">
                                <a href="/admin/kategori/olahraga">Kategori Olahraga</a>
                            </li>
                            <li class="submenu-item {{ request()->is('admin/kategori/fasilitas') ? 'active' : '' }}">
                                <a href="/admin/kategori/fasilitas">Kategori Fasilitas</a>
                            </li>
                            <li class="submenu-item {{ request()->is('admin/kategori/bank') ? 'active' : '' }}">
                                <a href="/admin/kategori/banks">Kategori Bank</a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (Auth::user()->hasRole('admin'))
                    <li class="sidebar-item {{ request()->is('admin/kontak') ? 'active' : '' }} ">
                        <a href="form-layout.html" class='sidebar-link'>
                            <i class="fa-solid fa-address-book" style="color: #080808;"></i>
                            <span class="text-dark">Kontak</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->hasRole('admin'))
                    <li class="sidebar-item {{ request()->is('admin/faqs') ? 'active' : '' }}  ">
                        <a href="table.html" class='sidebar-link'>
                            <i class="bi bi-grid-1x2-fill" style="color: #080808;"></i>
                            <span class="text-dark">FAQs</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
