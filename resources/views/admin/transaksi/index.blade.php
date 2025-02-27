@include('layouts.head')

<body>
    <div id="app">
        @include('layouts.sidebar')
        <div id="main">
            @include('layouts.navbar')
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Tabel Transaski</h3>
                            <p></p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Transaski</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <a href=""><span class="badge bg-success text-right pr-2">Tambah</span></a>
                        </div>
                        <div class="card-body">
                            <table class="table " id="table1" border="1">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Total Harga</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaksi as $value)
                                        <tr>
                                            <td>{{ $value->produk->nama }}</td>
                                            <td>Rp {{ number_format($value->total_harga, 0, ',', '.') }}</td>
                                            <td>{{ ucfirst($value->status) }}</td>
                                            <td><img src="{{ asset('storage/' . $value->gambar) }}" width="100">
                                            </td>
                                            <td>
                                                {{-- <a href="{{ route('transaksi.edit', $value->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                                <form action="{{ route('transaksi.destroy', $value->id) }}" method="POST"
                                                    style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                                </form> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </section>
            </div>


            @include('layouts.footer')
