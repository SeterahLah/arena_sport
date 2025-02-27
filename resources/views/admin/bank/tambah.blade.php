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
                            <h3>Tambah  Bank</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Nama  Bank</li>
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
                                    <form action="{{ route('bank.store') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Atas Nama</label>
                                                    <input name="nama" id="nama" class="form-control"
                                                        value="{{ old('nama') }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="rekening" class="form-label">No. Rekening</label>
                                                    <input name="rekening" id="rekening"
                                                        class="form-control" value="{{ old('rekening') }}"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="bank" class="form-label">Pilihan</label>
                                                    <select name="bank" id="bank" class="form-select" required>
                                                        <option value="">-- Pilih Kategori --</option>
                                                        @foreach ($kategori as $value)
                                                            <option value="{{ $value->nama_bank }}">{{ $value->nama_bank }}</option>
                                                        @endforeach
                                                    </select>
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
