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
                            <h3>Tabel Informasi</h3>
                            <p></p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Informasi</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('info.create') }}"><span
                                    class="badge bg-success text-right pr-2">Tambah</span></a>
                        </div>
                        <div class="card-body">
                            <table class="table " id="table1" border="1">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>By</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($infos as $info)
                                        <tr>
                                            <td>{{ $info->nama }}</td>
                                            <td>{{ $info->alamat }}</td>
                                            <td>{{ $info->by }}</td>
                                            <td><img src="{{ asset('storage/' . $info->gambar) }}" width="100"></td>
                                            <td>
                                                <a href="{{ route('info.edit', $info) }}"
                                                    class="btn btn-warning">Edit</a>
                                                <form action="{{ route('info.destroy', $info) }}" method="POST"
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
