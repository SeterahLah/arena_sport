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
                            <h3>Edit Slider</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Sliders</li>
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
                                    <form action="{{ route('slider.update', $slider->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12">
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Nama Slider</label>
                                                    <input name="nama" id="nama" class="form-control"
                                                        value="{{ old('nama', $slider->nama) }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="deskripsi_singkat" class="form-label">Deskripsi
                                                        Singkat</label>
                                                    <input name="deskripsi_singkat" id="deskripsi_singkat"
                                                        class="form-control"
                                                        value="{{ old('deskripsi_singkat', $slider->deskripsi_singkat) }}"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="url" class="form-label">Url Tujuan</label>
                                                    <input name="url" id="url" class="form-control"
                                                        value="{{ old('url', $slider->url) }}" required>
                                                    <!-- Menampilkan gambar lama -->
                                                    @if ($slider->gambar)
                                                        <div class="mt-2">
                                                            <p>Gambar Saat Ini:</p>
                                                            <img src="{{ asset('storage/' . $slider->gambar) }}"
                                                                alt="Gambar Slider" class="img-thumbnail"
                                                                width="200">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">

                                                <div class="mb-3">
                                                    <label for="pilihan" class="form-label">Pilihan</label>
                                                    <select name="pilihan" id="pilihan" class="form-select" required>
                                                        <option value="-"
                                                            {{ old('pilihan') == '-' ? 'selected' : '' }}>
                                                            ---------------------- Pilih Aksi ----------------------
                                                        </option>
                                                        <option value="Belanja Sekarang"
                                                            {{ old('pilihan', $slider->pilihan) == 'Belanja Sekarang' ? 'selected' : '' }}>
                                                            Belanja Sekarang</option>
                                                        <option value="Booking Sekarang"
                                                            {{ old('pilihan', $slider->pilihan) == 'Booking Sekarang' ? 'selected' : '' }}>
                                                            Booking Sekarang</option>
                                                        <option value="Kunjungi Sekarang"
                                                            {{ old('pilihan', $slider->pilihan) == 'Kunjungi Sekarang' ? 'selected' : '' }}>
                                                            Kunjungi Sekarang</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label for="gambar" class="form-label">Gambar Slider</label>
                                                    <input type="file" name="gambar" class="form-control" id="imageInput"
                                                        accept="image/*">
                                                </div>
                                                <br>
                                                <div>
                                                    <label for="" class="form-label">Cek Gambar</label>
                                                    <img id="preview" alt="Preview Gambar">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-warning">Update</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Basic File Browser end -->
            </div>

            @include('layouts.footer')
