@include('layout.head')
@include('layout.navbar')
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif


<!--Body Content-->
<div id="page-content">
    <!--Home slider-->
    <div class="slideshow slideshow-wrapper pb-section sliderFull">
        <div class="home-slideshow">
            @foreach ($sliders as $value)
                <div class="slide">
                    <div class="blur-up lazyload bg-size">
                        <img class="blur-up lazyload bg-img" data-src="{{ asset('storage/' . $value->gambar) }}"
                            src="{{ asset('storage/' . $value->gambar) }}" alt="Shop Our New Collection"
                            title="Shop Our New Collection" />
                        <div class="slideshow__text-wrap slideshow__overlay classic bottom">
                            <div class="slideshow__text-content bottom">
                                <div class="wrap-caption center">
                                    <h2 class="h1 mega-title slideshow__title">{{ $value->nama }}</h2>
                                    <span
                                        class="mega-subtitle slideshow__subtitle">{{ $value->deskripsi_singkat }}</span>
                                    <span class="btn"><a href="{{ $value->url }}">{{ $value->pilihan }}</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!--End Home slider-->
    <div class="">
        @foreach ($marquee as $value)
            <marquee class="text-dark bg-warning"><b>{{ $value->nama }}</b></marquee>
        @endforeach
    </div>

    <!--Collection Box slider-->
    <div class="collection-box section">
        <div class="container-fluid">
            <div class="section-header text-center">
                <h2 class="h2">Kategori Olahraga</h2>
            </div>
            <div class="collection-grid">
                @foreach ($olahraga as $value)
                    <div class="collection-grid-item">
                        <a href="collection-page.html" class="collection-grid-item__link">
                            <img data-src="{{ asset('storage/' . $value->gambar) }}"
                                src="{{ asset('storage/' . $value->gambar) }}" height="100px" alt="Fashion"
                                class="blur-up lazyload" />
                            <div class="collection-grid-item__title-wrapper">
                                <h3 class="collection-grid-item__title btn btn--secondary no-border">
                                    {{ $value->nama }}
                                </h3>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--End Collection Box slider-->

    <!--New Arrivals-->
    <div class="product-rows section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="section-header text-center">
                        <h2 class="h2">Booking lapangan</h2>
                    </div>
                </div>
            </div>
            <div class="grid-products">
                <div class="row">
                    @foreach ($lapangan as $value)
                        <div class="col-6 col-sm-2 col-md-3 col-lg-3 item ">
                            <!-- start product image -->
                            <div class="product-image ">
                                <!-- start product image -->
                                <a href="{{ route('booking.show', $value->id) }}" class="grid-view-item__link">
                                    <!-- image -->
                                    <img class="primary blur-up lazyload"
                                        data-src="{{ asset('storage/' . json_decode($value->gambar, true)[0]) }}"
                                        src="{{ asset('storage/' . json_decode($value->gambar, true)[0]) }}"
                                        alt="image" title="{{ $value->nama }}" height="400px">
                                    <!-- End image -->
                                    <!-- Hover image -->
                                    @if ($value->gambar)
                                        @foreach (json_decode($value->gambar, true) as $gambar)
                                            <img class="hover blur-up lazyload"
                                                data-src="{{ asset('storage/' . json_decode($value->gambar, true)[1]) }}"
                                                src="{{ asset('storage/' . json_decode($value->gambar, true)[1]) }}"
                                                alt="image" title="{{ $value->nama }}" height="400px">
                                        @endforeach
                                        <!-- End hover image -->
                                        <!-- Variant Image-->
                                    @else
                                        <img src="{{ asset('storage/' . json_decode($value->gambar, true)[1]) }}"
                                            alt="image" height="300px" height="400px">
                                    @endif
                                    <!-- Variant Image-->
                                </a>
                                <!-- end product image -->
                                <!-- Start product button -->
                                <form class="variants add" action="{{ route('cart.add1') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="lapangan_id" value="{{ $value->id }}">
                                    <button class="btn btn-addto-cart" type="submit">Masuk
                                        Keranjang</button>
                                </form>
                                <div class="button-set">
                                    <a href="{{ route('booking.show', $value->id) }}" title="Cek Detail"
                                        class="quick-view-popup quick-view" data-toggle="modal"
                                        data-target="#content_quickview">
                                        <i class="icon anm anm-search-plus-r"></i>
                                    </a>

                                </div>
                                <!-- end product button -->
                            </div>
                            <!-- end product image -->

                            <!--start product details -->
                            <div class="product-details text-center bg-secondary">
                                <!-- product name -->
                                <div class="product-name">
                                    <a href="{{ route('booking.show', $value->id) }}">{{ $value->nama }}</a>
                                </div>
                                <!-- End product name -->
                                <!-- product price -->
                                <div class="product-price">
                                    <span class="price">Rp. {{ number_format($value->harga, 2) }}</span>
                                </div>
                                <div class="product-review">
                                    <i class="font-13 fa fa-star"></i>
                                    <i class="font-13 fa fa-star"></i>
                                    <i class="font-13 fa fa-star"></i>
                                    <i class="font-13 fa fa-star-o"></i>
                                    <i class="font-13 fa fa-star-o"></i>
                                </div>
                                <!-- End product price -->
                            </div>
                            <!-- End product details -->
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center">
                        <a href="/booking" class="btn">Lihat Lainnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Featured Product-->




    <!--Featured Product-->
    <div class="product-rows section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="section-header text-center">
                        <h2 class="h2">Produk Olahraga</h2>
                        <p>Berbagai Produk Yang dibutukan saat Olahraga</p>
                    </div>
                </div>
            </div>
            <div class="grid-products">
                <div class="row">
                    @foreach ($produks as $value)
                        <div class="col-6 col-sm-6 col-md-2 col-lg-2 item grid-view-item style2">
                            <div class="grid-view_image ">
                                <!-- start product image -->
                                <a href="{{ route('belanja.show', $value->id) }}" class="grid-view-item__link">
                                    <!-- image -->
                                    <img class="grid-view-item__image primary blur-up lazyload"
                                        data-src="{{ asset('storage/' . json_decode($value->gambar, true)[0]) }}"
                                        src="{{ asset('storage/' . json_decode($value->gambar, true)[0]) }}"
                                        alt="image" title="product" height="300px">
                                    <!-- End image -->
                                    @if ($value->gambar)
                                        <!-- Hover image -->
                                        @foreach (json_decode($value->gambar, true) as $gambar)
                                            <img class="grid-view-item__image hover blur-up lazyload"
                                                data-src="{{ asset('storage/' . json_decode($value->gambar, true)[1]) }}"
                                                src="{{ asset('storage/' . json_decode($value->gambar, true)[1]) }}"
                                                alt="{{ $value->nama }}" title="{{ $value->nama }}"height="300px">
                                        @endforeach
                                    @else
                                        <img src="{{ asset('storage/' . json_decode($value->gambar, true)[1]) }}"
                                            alt="image" height="300px">
                                    @endif
                                    <!-- End hover image -->
                                    <!-- product label -->
                                    <div class="product-labels rectangular">
                                        <span class="lbl pr-label1">new</span>
                                    </div>
                                    <!-- End product label -->
                                </a>
                                <!-- end product image -->
                                <!--start product details -->
                                <div class="product-details hoverDetails text-center mobile">
                                    <!-- product name -->
                                    <div class="product-name">
                                        <a href="{{ route('belanja.show', $value->id) }}">{{ $value->nama }}</a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <span class="price">Rp. {{ number_format($value->harga, 2) }}</span>
                                    </div>
                                    <!-- End product price -->
                                    <div class="product-review">
                                        <i class="font-13 fa fa-star"></i>
                                        <i class="font-13 fa fa-star"></i>
                                        <i class="font-13 fa fa-star"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                    </div>
                                    <!-- product button -->
                                    <div class="button-set">
                                        <a href="{{ route('belanja.show', $value->id) }}" title="Cek Detailnya"
                                            class="quick-view-popup quick-view" data-target="#content_quickview">
                                            <i class="icon anm anm-search-plus-r"></i>
                                        </a>
                                        <!-- Start product button -->
                                        <form action="{{ route('cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $value->id }}">
                                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                                        </form>
                                    </div>
                                    <!-- end product button -->
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!--End Featured Product-->
    <!--Collection Tab slider-->
    <div class="tab-slider-product section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="section-header text-center">
                        <h2 class="h2">Produk Olahraga</h2>
                        <p>Berbagai Produk Yang dibutukan saat Olahraga</p>
                    </div>
                    <div class="tabs-listing">
                        <ul class="tabs clearfix">
                            @foreach ($categories as $index => $kategori)
                                <li class="{{ $index == 0 ? 'active' : '' }}" rel="tab{{ $index + 1 }}">
                                    {{ $kategori }}</li>
                            @endforeach
                        </ul>
                        <div class="tab_container">
                            @foreach ($productsByCategory as $category => $produk)
                                <div id="tab{{ $loop->index + 1 }}" class="tab_content grid-products"
                                    style="{{ $loop->first ? 'display:block;' : 'display:none;' }}">
                                    <div class="productSlider">
                                        @foreach ($produk as $product)
                                            <div class="col-12 item">
                                                <!-- start product image -->
                                                <div class="product-image">
                                                    <a href="">
                                                        <!-- image -->
                                                        <img class="primary blur-up lazyload"
                                                            src="{{ asset('storage/' . json_decode($product->gambar, true)[0]) }}"
                                                            alt="{{ $product->nama }}" title="{{ $product->nama }}">
                                                        <!-- Hover image -->
                                                        @if ($product->gambar)
                                                            @foreach (json_decode($product->gambar, true) as $gambar)
                                                                <img class="hover blur-up lazyload"
                                                                    src="{{ asset('storage/' . json_decode($product->gambar, true)[1]) }}"
                                                                    alt="image">
                                                            @endforeach
                                                        @else
                                                            <img src="{{ asset('storage/' . json_decode($product->gambar, true)[1]) }}"
                                                                alt="image">
                                                        @endif
                                                    </a>
                                                    <!-- Start product button -->
                                                    <form class="variants add" action="{{ route('cart.add') }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="product_id"
                                                            value="{{ $product->id }}">
                                                        <button class="btn btn-addto-cart" type="submit">Masuk
                                                            Keranjang</button>
                                                    </form>
                                                    <div class="button-set">
                                                        <a href="{{ route('belanja.show', $value->id) }}"
                                                            title="Cek Detailnya" class="quick-view-popup quick-view"
                                                            data-target="#content_quickview">
                                                            <i class="icon anm anm-search-plus-r"></i>
                                                        </a>
                                                    </div>
                                                    <!-- end product button -->
                                                </div>
                                                <!-- end product image -->

                                                <!-- start product details -->
                                                <div class="product-details text-center">
                                                    <div class="product-name">
                                                        <a
                                                            href="{{ route('belanja.show', $value->id) }}">{{ $product->nama }}</a>
                                                    </div>
                                                    <div class="product-price">
                                                        <span class="price">Rp.
                                                            {{ number_format($product->harga, 2) }}</span>
                                                    </div>
                                                    <div class="product-review">
                                                        <i class="font-13 fa fa-star"></i>
                                                        <i class="font-13 fa fa-star"></i>
                                                        <i class="font-13 fa fa-star"></i>
                                                        <i class="font-13 fa fa-star-o"></i>
                                                        <i class="font-13 fa fa-star-o"></i>
                                                    </div>
                                                </div>
                                                <!-- end product details -->
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!--Collection Tab slider-->
            <!--Logo Slider-->
            <div class="section logo-section">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="logo-bar">
                                <div class="logo-bar__item">
                                    <img src="{{ asset('template/assets/images/logo/brandlogo1.png') }}"
                                        alt="" title="" />
                                    <p class="text-center">uji coba aja lah</p>
                                </div>
                                <div class="logo-bar__item">
                                    <img src="{{ asset('template/assets/images/logo/brandlogo2.png') }}"
                                        alt="" title="" />
                                    <p class="text-center">uji coba aja lah</p>
                                </div>
                                <div class="logo-bar__item">
                                    <img src="{{ 'assets/images/logo/brandlogo3.png' }}" alt=""
                                        title="" />
                                </div>
                                <div class="logo-bar__item">
                                    <img src="{{ asset('template/assets/images/logo/brandlogo4.png') }}"
                                        alt="" title="" />
                                </div>
                                <div class="logo-bar__item">
                                    <img src="{{ asset('template/assets/images/logo/brandlogo5.png') }}"
                                        alt="" title="" />
                                </div>
                                <div class="logo-bar__item">
                                    <img src="{{ asset('template/assets/images/logo/brandlogo6.png') }}"
                                        alt="" title="" />
                                </div>
                                <div class="logo-bar__item">
                                    <img src="{{ asset('template/assets/images/logo/brandlogo6.png') }}"
                                        alt="" title="" />
                                </div>
                                <div class="logo-bar__item">
                                    <img src="{{ asset('template/assets/images/logo/brandlogo6.png') }}"
                                        alt="" title="" />
                                </div>
                                <div class="logo-bar__item">
                                    <img src="{{ asset('template/assets/images/logo/brandlogo6.png') }}"
                                        alt="" title="" />
                                </div>
                                <div class="logo-bar__item">
                                    <img src="{{ asset('template/assets/images/logo/brandlogo6.png') }}"
                                        alt="" title="" />
                                </div>
                                <div class="logo-bar__item">
                                    <img src="{{ asset('template/assets/images/logo/brandlogo6.png') }}"
                                        alt="" title="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Logo Slider-->

            <!--Latest Blog-->
            <div class="latest-blog section pt-0">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="section-header text-center">
                                <h2 class="h2">Informasi Berita</h2>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        @foreach ($info as $value)
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 ">
                                <div class="wrap-blog bg-secondary ">
                                    <a href="{{ route('infoo', $value->id) }}" class="article__grid-image">
                                        <img src="{{ asset('storage/' . $value->gambar) }}"
                                            alt="Klik disini untuk detail {{ $value->nama }}"
                                            title="Klik disini untuk detail {{ $value->nama }}"
                                            class="blur-up lazyloaded" height="400px" />
                                    </a>
                                    <div class="article__grid-meta article__grid-meta--has-image">
                                        <div class="wrap-blog-inner">
                                            <h2 class="h3 article__title">
                                                <a href="{{ route('infoo', $value->id) }}">{{ $value->nama }}</a>
                                            </h2>
                                            <span
                                                class="article__date">{{ $value->created_at->format('j, F Y') }}</span>
                                            <div class="rte article__grid-excerpt">
                                                {{ Str::limit($value->deskripsi, 10) }}
                                            </div>
                                            <ul class="list--inline article__meta-buttons">
                                                <li><a href="{{ route('infoo', $value->id) }}">Read more</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!--End Latest Blog-->

            <!--Store Feature-->
            <div class="store-feature section">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <ul class="display-table store-info">
                                <li class="display-table-cell">
                                    <i class="icon anm anm-truck-l"></i>
                                    <h5>Free Shipping &amp; Return</h5>
                                    <span class="sub-text">Free shipping on all US orders</span>
                                </li>
                                <li class="display-table-cell">
                                    <i class="icon anm anm-dollar-sign-r"></i>
                                    <h5>Money Guarantee</h5>
                                    <span class="sub-text">30 days money back guarantee</span>
                                </li>
                                <li class="display-table-cell">
                                    <i class="icon anm anm-comments-l"></i>
                                    <h5>Online Support</h5>
                                    <span class="sub-text">We support online 24/7 on day</span>
                                </li>
                                <li class="display-table-cell">
                                    <i class="icon anm anm-credit-card-front-r"></i>
                                    <h5>Secure Payments</h5>
                                    <span class="sub-text">All payment are Secured and trusted.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Store Feature-->
        </div>
        <!--End Body Content-->
        @include('layout.footer')
