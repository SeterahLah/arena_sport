@include('layout.head')

@include('layout.navbar')
<br><br><br><br>
<!--Body Content-->
<div id="page-content">
    <!--Page Title-->
    <div class="page section-header text-center mb-0">
        <div class="page-title">
            <div class="wrapper">
                <h1 class="page-width">Detail {{ $info->nama }}</h1>
            </div>
        </div>
    </div>
    <!--End Page Title-->
    <div class="bredcrumbWrap">
        <div class="container breadcrumbs">
            <a href="/" title="Back to the home page">Beranda</a><span aria-hidden="true">›</span>
            <span>Detail {{ $info->nama }}</span>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <!--Main Content-->
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
                <div class="blog--list-view">
                    <div class="article">
                        <!-- Article Image -->
                        <a class="article_featured-image" href="#"><img class="blur-up lazyload"
                                data-src="{{ asset('storage/' . $info->gambar) }}"
                                src="{{ asset('storage/' . $info->gambar) }}" alt="It's all about how you wear"></a>
                        <h1><a href="blog-left-sidebar.html">{{ $info->nama }}</a></h1>
                        <ul class="publish-detail">
                            <li><i class="anm anm-user-al" aria-hidden="true"></i> {{ $info->by }}</li>
                            <li><i class="icon anm anm-clock-r"></i> <time
                                    datetime="2017-05-02">{{ $info->created_at->format('j, F Y') }}</time></li>
                            <li>
                                <ul class="inline-list">
                                    <li><i class="icon anm anm-comments-l"></i> <a href="#"> 0 comments</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="rte">
                            {{ strip_tags($info->deskripsi) }}
                        </div>
                        <hr />
                    </div>
                    <div class="formFeilds contact-form form-vertical">
                        <form method="post" action="#" id="comment_form" accept-charset="UTF-8"
                            class="comment-form">
                            <h2>Leave a comment</h2>
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <input type="text" id="ContactFormName" name="contact[name]"
                                            placeholder="Name" value="" required="">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <input type="email" id="ContactFormEmail" name="contact[email]"
                                            placeholder="Email" value="" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <textarea required="" rows="10" id="ContactFormMessage" name="contact[body]" placeholder="Your Message"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <p class="fine-print">Please note, comments must be approved before they are
                                        published</p>
                                    <input type="submit" class="btn" value="Send Message">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Main Content-->
    @include('layout.footer')
