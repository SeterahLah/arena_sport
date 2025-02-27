@include('layouts.head')

<body>
    <div id="app">
        @include('layouts.sidebar')
        <div id="main" class=''>
            @include('layouts.navbar')
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Tambah Kategori Fasilitas</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Nama Kategori Fasilitas</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Basic File Browser start -->
                <section id="input-file-browser">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{ route('fasilitas.store') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12">
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Nama Fasilitas</label>
                                                    <input name="nama" id="nama" class="form-control"
                                                    value="{{ old('nama') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">logo</label>
                                                    <input name="logo" id="logo" class="form-control"
                                                        value="{{ old('logo') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <button type="submit" class="btn btn-warning">Simpan</button>
                                </form>

                            </div>
                        </div>
                    </div>
            </div>
            </section>
            <!-- Basic File Browser end -->
        </div>
        @include('layouts.footer')
