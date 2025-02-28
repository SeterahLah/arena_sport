<div class="pageWrapper">
    <!--Search Form Drawer-->
    <div class="search">
        <div class="search__form">
            <form class="search-bar__form" action="#">
                <button class="go-btn search__button" type="submit"><i class="icon anm anm-search-l"></i></button>
                <input class="search__input" type="search" name="q" value="" placeholder="Cari disini..."
                    aria-label="Search" autocomplete="off">
            </form>
            <button type="button" class="search-trigger close-btn"><i class="anm anm-times-l"></i></button>
        </div>
    </div>
    <!--End Search Form Drawer-->
    <!--Top Header-->
    <div class="top-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-10 col-sm-8 col-md-5 col-lg-4">
                    <div class="currency-picker">

                    </div>
                    <div class="language-dropdown">

                    </div>

                </div>
                <div class="col-sm-4 col-md-4 col-lg-4 d-none d-lg-none d-md-block d-lg-block">

                </div>
                <div class="col-2 col-sm-4 col-md-3 col-lg-4 text-right">
                    <span class="user-menu d-block d-lg-none"><i class="anm anm-user-al" aria-hidden="true"></i></span>
                    <ul class="customer-links list-inline">
                        @guest
                            <!-- Jika user belum login, tampilkan tombol Login & Register -->
                            <li class="nav-item">
                                <a href="/login">Login</a>
                            </li>
                            <li class="nav-item">
                                <a href="/register">Register</a>
                            </li>
                        @else
                            <!-- Jika user sudah login, tampilkan tombol Dashboard dan Logout -->
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="dropdown-item" href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="icon-mid bi bi-box-arrow-left me-2"></i> Logout
                                </a>
                                <form id="logout-form" method="POST" action="{{ route('logout.user') }}"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--End Top Header-->
    <!--Header-->
    <div class="header-wrap classicHeader animated d-flex">
        <div class="container-fluid">
            <div class="row align-items-center">
                <!--Desktop Logo-->
                <div class="logo col-md-2 col-lg-2 d-none d-lg-block">
                    <a href="/">
                        <img src="{{ asset('template/assets/images/arena.svg') }}" alt="arena sport"
                            title="arena sport" />
                    </a>
                </div>
                <!--End Desktop Logo-->
                <div class="col-2 col-sm-3 col-md-3 col-lg-7">
                    <div class="d-block d-lg-none">
                        <button type="button"
                            class="btn--link site-header__menu js-mobile-nav-toggle mobile-nav--open">
                            <i class="icon anm anm-times-l"></i>
                            <i class="anm anm-bars-r"></i>
                        </button>
                    </div>
                    <!--Desktop Menu-->
                    <nav class="grid__item" id="AccessibleNav">
                        <!-- for mobile -->
                        <ul id="siteNav" class="site-nav medium center hidearrow">
                            <li class="lvl1 parent megamenu"><a href="/">Beranda<i
                                        class="anm anm-angle-down-l"></i></a>
                            </li>
                            <li class="lvl1 parent megamenu"><a href="/booking">Booking <i
                                        class="anm anm-angle-down-l"></i></a>
                            </li>
                            <li class="lvl1 parent megamenu"><a href="/belanja">Belanja <i
                                        class="anm anm-angle-down-l"></i></a>
                            </li>
                            <li class="lvl1 parent megamenu"><a href="#">Sparing <i
                                        class="anm anm-angle-down-l"></i></a>
                            </li>
                            <li class="lvl1 parent dropdown"><a href="#">Informasi <i
                                        class="anm anm-angle-down-l"></i></a>
                                <ul class="dropdown">
                                    <li><a href="/info" class="site-nav">Berita</a></li>
                                    <li><a href="#" class="site-nav">Event</a></li>
                                </ul>
                            </li>
                            <li class="lvl1 parent dropdown"><a href="#">Kontak<i
                                        class="anm anm-angle-down-l"></i></a>
                            </li>
                        </ul>
                    </nav>
                    <!--End Desktop Menu-->
                </div>
                <!--Mobile Logo-->
                <div class="col-6 col-sm-6 col-md-6 col-lg-2 d-block d-lg-none mobile-logo">
                    <div class="logo">
                        <a href="index.html">
                            <img src="{{ asset('template/assets/images/arena.svg') }}" alt="arena sport"
                                title="arena sport" />
                        </a>
                    </div>
                </div>
                <!--Mobile Logo-->
                <div class="col-4 col-sm-3 col-md-3 col-lg-3">
                    <div class="site-cart">
                        <a href="#;" class="site-header__cart" title="Cart">
                            <i class="icon anm anm-bag-l"></i>
                            @php
                                $cartCount = Auth::check()
                                    ? \App\Models\Cart::where('user_id', Auth::id())->sum('quantity')
                                    : 0;
                            @endphp

                            <span id="CartCount" class="site-header__cart-count" data-cart-render="item_count">
                                {{ $cartCount }}
                            </span>

                        </a>
                        <!--Minicart Popup-->
                        @php
                            $cartItems = \App\Models\Cart::where('user_id', Auth::id())->with('produk')->get();
                            $lapangan = \App\Models\CartLapangan::where('user_id', Auth::id())->with('lapangan')->get();
                            $totalPrice = $cartItems->sum(fn($item) => $item->quantity * $item->harga);
                            $totalPrice1 = $lapangan ->sum(fn($value) => $value->quantity * $value->harga);
                            $totalsemua = $totalPrice + $totalPrice1;
                        @endphp

                        <!--Minicart Popup-->
                        <div id="header-cart" class="block block-cart">
                            <ul class="mini-products-list">
                                {{-- produk --}}
                                <h4 class="text-center"><b>Keranjang Produk</b></h4><br>
                                @foreach ($cartItems as $item)
                                    @php
                                        $gambarArray = json_decode($item->produk->gambar, true);
                                        $gambarPertama = $gambarArray[0] ?? 'default-product.jpg';
                                    @endphp
                                    <li class="item">
                                        <a class="product-image" href="#">
                                            <img src="{{ asset('storage/' . $gambarPertama) }}"
                                                alt="{{ $item->produk->nama }}" />
                                        </a>
                                        <div class="product-details">
                                            <a href="#" class="remove"
                                                onclick="removeCart({{ $item->id }})"><i
                                                    class="anm anm-times-l"></i></a>
                                            <a class="pName" href="#">{{ $item->produk->nama }}</a>
                                            <div class="variant-cart">{{ $item->produk->variant }}</div>
                                            <div class="wrapQtyBtn">
                                                <div class="qtyField">
                                                    <span class="label">Qty:</span>
                                                    <a class="qtyBtn minus" href="javascript:void(0);"
                                                        onclick="updateCart({{ $item->id }}, {{ $item->quantity - 1 }})"><i
                                                            class="fa anm anm-minus-r"></i></a>
                                                    <input type="text" name="quantity"
                                                        value="{{ $item->quantity }}"
                                                        class="product-form__input qty">
                                                    <a class="qtyBtn plus" href="javascript:void(0);"
                                                        onclick="updateCart({{ $item->id }}, {{ $item->quantity + 1 }})"><i
                                                            class="fa anm anm-plus-r"></i></a>
                                                </div>
                                            </div>
                                            <div class="priceRow">
                                                <div class="product-price">
                                                    <span
                                                        class="money">${{ number_format($item->quantity * $item->harga, 2) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                                {{-- booking --}}
                                <h4 class="text-center"><b>Keranjang Booking</b></h4><br>
                                @foreach ($lapangan as $value)
                                    @php
                                        $gambarArray = json_decode($value->lapangan->gambar, true);
                                        $gambarPertama = $gambarArray[0] ?? 'default-product.jpg';
                                    @endphp
                                    <li class="item">
                                        <a class="product-image" href="#">
                                            <img src="{{ asset('storage/' . $gambarPertama) }}"
                                                alt="{{ $value->lapangan->nama }}" />
                                        </a>
                                        <div class="product-details">
                                            <a href="#" class="remove"
                                                onclick="removeCart1({{ $value->id }})"><i
                                                    class="anm anm-times-l"></i></a>
                                            <a class="pName" href="#">{{ $value->lapangan->nama }}</a>
                                            <div class="variant-cart">{{ $value->lapangan->variant }}</div>
                                            <div class="wrapQtyBtn">
                                                <div class="qtyField">
                                                    <span class="label">Qty:</span>
                                                    <a class="qtyBtn minus" href="javascript:void(0);"
                                                        onclick="updateCart1({{ $value->id }}, {{ $value->quantity - 1 }})"><i
                                                            class="fa anm anm-minus-r"></i></a>
                                                    <input type="text" name="quantity"
                                                        value="{{ $value->quantity }}"
                                                        class="product-form__input qty">
                                                    <a class="qtyBtn plus" href="javascript:void(0);"
                                                        onclick="updateCart1({{ $value->id }}, {{ $value->quantity + 1 }})"><i
                                                            class="fa anm anm-plus-r"></i></a>
                                                </div>
                                            </div>
                                            <div class="priceRow">
                                                <div class="product-price">
                                                    <span
                                                        class="money">${{ number_format($value->quantity * $value->harga, 2) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="total">
                                <div class="total-in">
                                    <span class="label">Cart Subtotal:</span><span class="product-price"><span
                                            class="money">${{ number_format($totalsemua, 2) }}</span></span>
                                </div>
                                <div class="buttonSet text-center">
                                    <a href="/checkout/booking/booking" class="btn btn-secondary btn--small">Proses Booking</a>
                                    <form action="{{ route('checkout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-secondary btn--small">Checkout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--EndMinicart Popup-->
                        {{-- untuk produk --}}
                        <script>
                            function updateCart(id, quantity) {
                                fetch(`/cart/update/${id}`, {
                                    method: "POST",
                                    headers: {
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                        "Content-Type": "application/json"
                                    },
                                    body: JSON.stringify({
                                        quantity
                                    })
                                }).then(() => location.reload());
                            }

                            function removeCart(id) {
                                fetch(`/cart/remove/${id}`, {
                                    method: "DELETE",
                                    headers: {
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                        "Content-Type": "application/json"
                                    }
                                }).then(() => location.reload());
                            }

                            function checkout() {
                                fetch(`/cart/checkout`, {
                                    method: "POST",
                                    headers: {
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                    }
                                }).then(() => location.reload());
                            }
                        </script>
                        {{-- untuk booking --}}
                        <script>
                            function updateCart1(id, quantity) {
                                fetch(`/cartlapangan/update/${id}`, {
                                    method: "POST",
                                    headers: {
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                        "Content-Type": "application/json"
                                    },
                                    body: JSON.stringify({
                                        quantity
                                    })
                                }).then(() => location.reload());
                            }

                            function removeCart1(id) {
                                fetch(`/cartlapangan/remove/${id}`, {
                                    method: "DELETE",
                                    headers: {
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                        "Content-Type": "application/json"
                                    }
                                }).then(() => location.reload());
                            }

                            function checkout1() {
                                fetch(`/cartlapangan/checkout`, {
                                    method: "POST",
                                    headers: {
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                    }
                                }).then(() => location.reload());
                            }
                        </script>
                    </div>
                    {{-- kerajang lapangan --}}
                    <div class="site-header__search">
                        <button type="button" class="search-trigger"><i class="icon anm anm-search-l"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Header-->
    <!--Mobile Menu-->
    <div class="mobile-nav-wrapper" role="navigation">
        <div class="closemobileMenu"><i class="icon anm anm-times-l pull-right"></i> Close Menu</div>
        <ul id="MobileNav" class="mobile-nav">
            <li class="lvl1 parent megamenu"><a href="/">Beranda<i class="anm anm-angle-down-l"></i></a>
            </li>
            <li class="lvl1 parent megamenu"><a href="/booking">Booking <i class="anm anm-angle-down-l"></i></a>
            </li>
            <li class="lvl1 parent megamenu"><a href="/belanja">Belanja <i class="anm anm-angle-down-l"></i></a>
            </li>
            <li class="lvl1 parent megamenu"><a href="#">Sparing <i class="anm anm-angle-down-l"></i></a>
            </li>
            <li class="lvl1 parent dropdown"><a href="#">Informasi <i class="anm anm-angle-down-l"></i></a>
                <ul class="dropdown">
                    <li><a href="/info" class="site-nav">Berita</a></li>
                    <li><a href="#" class="site-nav">Event</a></li>
                </ul>
            </li>
            <li class="lvl1 parent dropdown"><a href="#">Kontak<i class="anm anm-angle-down-l"></i></a>
            </li>
            @guest
                <!-- Jika user belum login, tampilkan tombol Login & Register -->
                <li class="nav-item">
                    <a href="/login">Login</a>
                </li>
                <li class="nav-item">
                    <a href="/register">Register</a>
                </li>
            @else
                <!-- Jika user sudah login, tampilkan tombol Dashboard dan Logout -->
                {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                            </li> --}}
                <li class="nav-item">
                    <a class="dropdown-item" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="icon-mid bi bi-box-arrow-left me-2"></i> Logout
                    </a>
                    <form id="logout-form" method="POST" action="{{ route('logout.user') }}" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endguest
        </ul>
    </div>
    <!--End Mobile Menu-->
