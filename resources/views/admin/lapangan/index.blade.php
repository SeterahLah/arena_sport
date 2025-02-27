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
                            <h3>Tabel Lapangan</h3>
                            <p></p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Lapangan</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('lapangan.create') }}"><span
                                    class="badge bg-success text-right pr-2">Tambah</span></a>
                        </div>
                        <div class="card-body">
                            <table class="table " id="table1" border="1">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>fasilitas</th>
                                        <th>Gambar</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lapangan as $value)
                                        <tr>
                                            <td>{{ $value->nama }}</td>
                                            <td>{{ number_format($value->harga, 0, ',', '.') }}</td>
                                            <td>
                                                @if (!empty(json_decode($value->fasilitas, true)))
                                                    @foreach (json_decode($value->fasilitas, true) as $fasilitas)
                                                        {!!  $fasilitas !!}
                                                    @endforeach
                                                @else
                                                    Tidak ada fasilitas
                                                @endif
                                            </td>
                                            <td>
                                                @foreach (json_decode($value->gambar, true) as $gambar)
                                                    <img src="{{ asset('storage/' . $gambar) }}" width="50">
                                                @endforeach
                                            </td>
                                            <td>{{ $value->status }}</td>
                                            <td>
                                                <a href="{{ route('lapangan.edit', $value->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                                <form action="{{ route('lapangan.destroy', $value->id) }}" method="POST"
                                                    style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                                </form>
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
