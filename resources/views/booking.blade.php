@include('layout.head')

@include('layout.navbar')

<!--Body Content-->
<div id="page-content">
    <!--Collection Banner-->
    <div class="collection-header">
        <div class="collection-hero">
            <div class="collection-hero__image"><img class="blur-up lazyload"
                    data-src="{{ asset('template/assets/images/cat-men.jpg') }}"
                    src="{{ asset('template/assets/images/cat-men.jpg') }}" alt="" title="" /></div>
            <div class="collection-hero__title-wrapper">
                <h1 class="collection-hero__title page-width">Semua Lapangan</h1>
            </div>
        </div>
    </div>
    <br><br>
    <!--End Collection Banner-->

    <div class="container">
        <div class="row">
            <!--Main Content-->
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col shop-grid-6">
                <div class="productList">
                    <div class="grid-products grid--view-items">
                        <div class="row">
                            @foreach ($lapangan as $value)
                                <div class="col-6 col-sm-6 col-md-4 col-lg-2 item">
                                    <!-- start product image -->
                                    <div class="product-image">
                                        <!-- start product image -->
                                        <a href="{{ route('booking.show', $value->id) }}">
                                            <!-- image -->
                                            <img class="primary blur-up lazyload"
                                                data-src="{{ asset('storage/' . json_decode($value->gambar, true)[0]) }}"
                                                src="{{ asset('storage/' . json_decode($value->gambar, true)[0]) }}"
                                                alt="image" title="{{ $value->nama }}" height="300px" >
                                            <!-- End image -->
                                            <!-- Hover image -->
                                            @if ($value->gambar)
                                                @foreach (json_decode($value->gambar, true) as $gambar)
                                                    <img class="hover blur-up lazyload"
                                                        data-src="{{ asset('storage/' . json_decode($value->gambar, true)[1]) }}"
                                                        src="{{ asset('storage/' . json_decode($value->gambar, true)[1]) }}"
                                                        alt="image" title="{{ $value->nama }}" height="300px" >
                                                @endforeach
                                                <!-- End hover image -->
                                                <!-- Variant Image-->
                                            @else
                                                <img src="{{ asset('storage/' . json_decode($value->gambar, true)[1]) }}"
                                                    alt="image" height="300px" >
                                            @endif
                                            <!-- End hover image -->
                                        </a>
                                        <!-- end product image -->
                                        <!-- Start product button -->
                                        <form class="variants add" action="#"
                                            onclick="window.location.href='cart.html'"method="post">
                                            <button class="btn btn-addto-cart" type="button">Tambah Keranjang</button>
                                        </form>
                                        <div class="button-set">
                                            <a href="{{ route('booking.show', $value->id) }}" title=" Cek detail {{ $value->nama }}"
                                                class="quick-view-popup quick-view" >
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
                                            <span class="price">Rp. {{ number_format($value->harga) }}</span>
                                        </div>
                                        <!-- End product price -->

                                        <div class="product-review">
                                            <i class="font-13 fa fa-star"></i>
                                            <i class="font-13 fa fa-star"></i>
                                            <i class="font-13 fa fa-star"></i>
                                            <i class="font-13 fa fa-star-o"></i>
                                            <i class="font-13 fa fa-star-o"></i>
                                        </div>
                                    </div>
                                    <div></div>
                                    <!-- End product details -->
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="infinitpaginOuter">
                    <div class="infinitpagin">
                        <a href="#" class="btn loadMore">Yang Lainnya</a>
                    </div>
                </div>
            </div>
            <!--End Main Content-->
        </div>
    </div>

</div>
<!--End Body Content-->


<br><br><br>
@include('layout.footer')
