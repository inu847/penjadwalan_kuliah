@extends('dashboard.layouts.main')

@section('content')
    <div class="pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3"><i class="fas fa-users"></i> Halaman Data Ruang</h1>
    </div>

    <div class="row">
        <div class="col-lg-6">Form</div>
        <div class="col-lg-6">
            <button type="button" class="btn btn-success" style="float: right;" data-bs-toggle="modal"
                data-bs-target="#ruangModal">
                <i class="fa fa-plus"></i> Tambah Data
            </button>
        </div>
    </div>
    <br>

    <!-- Modal -->
    <div class="modal fade" id="ruangModal" tabindex="-1" aria-labelledby="ruangModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="matkulModalLabel">Tambah Data Ruang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('ruang.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_ruang" class="form-label">Nama Ruang</label>
                            <input type="text" name="nama_ruang" class="form-control" id="nama_ruang" name="nama_ruang" required>
                        </div>
                        <div class="mb-3">
                            <label for="kapasitas" class="form-label">Kapasitas</label>
                            <input type="number" name="kapasitas" class="form-control" id="kapasitas" name="kapasitas" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis" class="form-label">Jenis</label>
                            <input type="text" name="jenis" class="form-control" id="jenis" name="jenis" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Ruang</th>
                <th scope="col">Kapasitas</th>
                <th scope="col">Jenis</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php $count = 1; ?>
            @foreach ($semua_ruang as $ruang)
                <tr>
                    <td>{{ $count }}</td>
                    <td>{{ $ruang->nama_ruang }}</td>
                    <td>{{ $ruang->kapasitas }}</td>
                    <td>{{ $ruang->jenis }}</td>
                    <td>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#ruangEdit{{ $ruang->kode_ruang }}"
                            class="btn btn-warning"><i class="fa fa-edit"></i></button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#hapus{{ $ruang->kode_ruang }}Modal"
                            class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        {{-- <a href="/ruang/delete/{{ $ruang->kode_ruang }}" class="btn btn-danger"><i class="fa fa-trash"></i></a> --}}
                    </td>
                </tr>
                <?php $count++; ?>
            @endforeach
        </tbody>
    </table>

    @foreach ($semua_ruang as $ruang)
        <!-- Modal Edit -->
        <div class="modal fade" id="ruangEdit{{ $ruang->kode_ruang }}" tabindex="-1"
            aria-labelledby="ruangEdit{{ $ruang->kode_ruang }}Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ruangEdit{{ $ruang->kode_ruang }}Label">Edit Data Ruang</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('ruang.update', [$ruang->kode_ruang]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="{{ $ruang->kode_ruang }}" name="kode_ruang">
                            <div class="mb-3">
                                <label for="nama_ruang" class="form-label">Nama Ruang</label>
                                <input type="text" name="nama_ruang" class="form-control" id="nama_ruang"
                                    value="{{ $ruang->nama_ruang }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="kapasitas" class="form-label">Kapasitas</label>
                                <input type="number" name="kapasitas" class="form-control" id="kapasitas"
                                    value="{{ $ruang->kapasitas }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="jenis" class="form-label">Jenis</label>
                                <input type="text" name="jenis" class="form-control" id="jenis"
                                    value="{{ $ruang->jenis }}" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Hapus --}}
        <div class="modal fade" id="hapus{{ $ruang->kode_ruang }}Modal" tabindex="-1"
            aria-labelledby="hapus{{ $ruang->kode_ruang }}ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="hapus{{ $ruang->kode_ruang }}ModalLabel">Apakah Ingin Hapus Data
                            ?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger" onclick="$('#delete{{$ruang->kode_ruang}}').submit()">Hapus</button>
                        <form id="delete{{$ruang->kode_ruang}}" action='{{ route('ruang.destroy', [$ruang->kode_ruang]) }}' method='POST' enctype='multipart/form-data'>
                        @method('DELETE')
                        @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
