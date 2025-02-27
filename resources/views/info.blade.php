@include('layout.head')

@include('layout.navbar')

<!--Body Content-->
<div id="page-content">
    <br><br><br><br>
    <!--Page Title-->
    <div class="page section-header text-center mb-0">
        <div class="page-title">
            <div class="wrapper">
                <h1 class="page-width">Berita Olaraga</h1>
            </div>
        </div>
    </div>
    <!--End Page Title-->
    <div class="bredcrumbWrap">
        <div class="container breadcrumbs">
            <a href="/" title="Beranda">Beranda</a><span aria-hidden="true">›</span><span>Berita Olahraga</span>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <!--Main Content-->
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
                <div class="custom-search">
                    <form action="http://127.0.0.1:8000/search" method="get" class="input-group search-header search"
                        role="search" style="position: relative;">
                        <input class="search-header__input search__input input-group__field" type="search"
                            name="q" placeholder="Search" aria-label="Search" autocomplete="off">
                        <span class="input-group__btn"><button class="btnSearch" type="submit"> <i
                                    class="icon anm anm-search-l"></i> </button></span>
                    </form>
                </div>
                <div class="blog--list-view blog--grid-load-more">
                    @foreach ($info as $value)
                        <div class="article">
                            <!-- Article Image -->
                            <a class="article_featured-image" href="{{ route('infoo', $value->id) }}"><img class="blur-up lazyload"
                                    data-src="{{ ('storage/'. $value->gambar) }}"
                                    src="{{ ('storage/'. $value->gambar) }}" alt="It's all about how you wear"></a>
                            <h2 class="h3"><a href="{{ route('infoo', $value->id) }}">{{ $value->nama }}</a></h2>
                            <ul class="publish-detail">
                                <li><i class="anm anm-user-al" aria-hidden="true"></i> {{$value->by}}</li>
                                <li><i class="icon anm anm-clock-r"></i> <time datetime="{{ $value->created_at->format('j, F Y') }}">{{ $value->created_at->format('j, F Y') }}</time>
                                </li>
                                <li>
                                    <ul class="inline-list">
                                        <li><i class="icon anm anm-comments-l"></i> <a href="#"> 0 comments</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <div class="rte">
                                <p>{{ strip_tags($value->deskripsi) }}
                                </p>
                            </div>
                            <p><a href="{{ route('infoo', $value->id) }}" class="btn btn-secondary btn--small">Read more <i
                                        class="fa fa-caret-right" aria-hidden="true"></i></a></p>
                        </div>
                    @endforeach
                    <div class="loadmore-post">
                        <a href="#;" class="btn loadMorepost">Berita Lainnya</a>
                    </div>
                </div>
            </div>
            <!--End Main Content-->
        </div>
    </div>

</div>
<!--End Body Content-->
@include('layout.footer')
