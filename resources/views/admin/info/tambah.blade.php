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
                            <h3>Tambah Informasi</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Informasi</li>
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
                                    <form action="{{ route('info.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12">
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Nama Informasi</label>
                                                    <input name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                                    <textarea name="deskripsi" id="summernote" class="form-control" value="{{ old('deskripsi') }}" required>{{ old('deskripsi') }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="alamat" class="form-label">Alamat</label>
                                                    <input name="alamat" id="alamat" class="form-control" value="{{ old('url') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">

                                                <div class="mb-3">
                                                    <label for="by" class="form-label">By</label>
                                                    <input name="by" id="by" class="form-control" value="{{ old('url') }}" required>
                                                </div>
                                                <div>
                                                    <label for="gambar" class="form-label">Gambar Informasi</label>
                                                    <input type="file"  name="gambar" id="imageInput" class="form-control" accept="image/*" require>
                                                </div>
                                                <br>
                                                <div>
                                                    <label for="" class="form-label" >Cek Gambar</label>
                                                    <img id="preview"  alt="Preview Gambar">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-warning">Simpan</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Basic File Browser end -->
            </div>

            @include('layouts.footer')
