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
                            <h3>Tambah Produk</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Produk</li>
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
                                    <form action="{{ route('produk.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-4 col-md-12">
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Nama Produk</label>
                                                    <input name="nama" id="nama" class="form-control"
                                                        value="{{ old('nama') }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="alamat" class="form-label">Alamat</label>
                                                    <input type="textarea" name="alamat" id="alamat"
                                                        class="form-control" value="{{ old('alamat') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <div class="mb-3">
                                                    <label for="harga" class="form-label">Harga</label>
                                                    <input type="number" step="0.01" name="harga" id="harga"
                                                        class="form-control" value="{{ old('harga') }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="berat" class="form-label">Berat</label>
                                                    <input type="number" step="0.01" name="berat" id="harga"
                                                        class="form-control" value="{{ old('berat') }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Status</label>
                                                    <select name="status" id="status" class="form-select" required>
                                                        <option value="-"
                                                            {{ old('status') == '-' ? 'selected' : '' }}>
                                                            ---------------------- Pilih Aksi ----------------------
                                                        </option>
                                                        <option value="Aktif"
                                                            {{ old('status') == 'Aktif' ? 'selected' : '' }}>
                                                            Aktif</option>
                                                        <option value="Tidak Aktif"
                                                            {{ old('status') == 'Tidak Aktif' ? 'selected' : '' }}>
                                                            Tidak Aktif</option>
                                                        <option value="Stok Habis"
                                                            {{ old('status') == 'Stok Habis' ? 'selected' : '' }}>
                                                            Stok Habis</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <div class="mb-3">
                                                    <label for="stok" class="form-label">Stok</label>
                                                    <input type="number" name="stok" id="stok"
                                                        class="form-control" value="{{ old('stok') }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="kategori" class="form-label">Kategori</label>
                                                    <select name="kategori" id="kategori" class="form-select" required>
                                                        <option value="-"
                                                            {{ old('kategori') == '-' ? 'selected' : '' }}>
                                                            ---------------------- Pilih Aksi ----------------------
                                                        </option>
                                                        <option value="Pakaian"
                                                            {{ old('kategori') == 'Pakaian' ? 'selected' : '' }}>
                                                            Pakaian</option>
                                                        <option value="Alat"
                                                            {{ old('kategori') == 'Alat' ? 'selected' : '' }}>
                                                            Alat</option>
                                                        <option value="Makanan Atau Kesehatan"
                                                            {{ old('kategori') == 'Makanan Atau Kesehatan' ? 'selected' : '' }}>
                                                            Makanan Atau Kesehatan</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="mb-3">
                                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                                <textarea name="deskripsi" value="{{ old('deskripsi') }}" id="myEditor" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="mb-3">
                                                <label for="gambar" class="form-label">Gambar Produk</label>
                                                <input type="file" class="form-control" name="gambar[]"
                                                    id="gambarInput" multiple accept="image/*"
                                                    onchange="previewImages()">
                                            </div>
                                            <br>
                                            <div class="mb-3">
                                                <label for="" class="form-label">Cek Gambar</label>
                                                <div id="imagePreview"> </div>
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
