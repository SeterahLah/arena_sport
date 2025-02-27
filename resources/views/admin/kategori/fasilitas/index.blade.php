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
                            <h3>Tabel Fasilitas</h3>
                            <p></p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">FAsilitas</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('fasilitas.create') }}"><span
                                    class="badge bg-success text-right pr-2">Tambah</span></a>
                        </div>
                        <div class="card-body">
                            <table class="table " id="table1" border="1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Fasilitas</th>
                                        <th>Logo</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($fasilitas as $value)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $value->nama }}</td>
                                            <td>{!! $value->logo !!}</td> 
                                            {{-- jika ingin menampilkan logo yg dirender html --}}
                                            <td>
                                                <a href="{{ route('fasilitas.edit', $value->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                                <form action="{{ route('fasilitas.destroy', $value->id) }}" method="POST"
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
