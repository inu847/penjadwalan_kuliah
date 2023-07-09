@extends('dashboard.layouts.main')

@section('content')
    <div class="pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3"><i class="fas fa-users"></i> Halaman Data Hari</h1>
    </div>

    <div class="row">
        <div class="col-lg-6">Form</div>
        <div class="col-lg-6">
            {{-- <button type="button" class="btn btn-success" style="float: right;" data-bs-toggle="modal"
                data-bs-target="#hariModal">
                <i class="fa fa-plus"></i> Tambah Data
            </button> --}}
        </div>
    </div>
    <br>

    <!-- Modal Tambah -->
    {{-- <div class="modal fade" id="hariModal" tabindex="-1" aria-labelledby="hariModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="hariModalLabel">Tambah Data Hari</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/hari/tambah" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_hari" class="form-label">Nama Hari</label>
                            <input type="text" name="nama_hari" class="form-control" id="nama_hari" name="nama_hari"
                                required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Tombol Hapus -->
    <table id="table" class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Hari</th>
                {{-- <th scope="col">Aksi</th> --}}
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php $count = 1; ?>
            @foreach ($semua_hari as $hari)
                <tr>
                    <td>{{ $count }}</td>
                    <td>{{ $hari }}</td>
                    {{-- <td>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#hariEdit{{ $hari->kode_hari }}"
                            class="btn btn-warning"><i class="fa fa-edit"></i></button>
                        <a href="/hari/delete/{{ $hari->kode_hari }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </td> --}}
                </tr>
                <?php $count++; ?>
            @endforeach
        </tbody>
    </table>

    <!-- Modal Edit -->
    {{-- @foreach ($semua_hari as $hari)
        <div class="modal fade" id="hariEdit{{ $hari->kode_hari }}" tabindex="-1"
            aria-labelledby="hariEdit{{ $hari->kode_hari }}Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="hariEdit{{ $hari->kode_hari }}Label">Edit Data Hari</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/hari/update" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $hari->kode_hari }}" name="kode_hari">
                            <div class="mb-3">
                                <label for="nama_hari" class="form-label">Nama Hari</label>
                                <input type="text" name="nama_hari" class="form-control" id="nama_hari"
                                    value="{{ $hari->nama_hari }}" required>
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
    @endforeach --}}
@endsection
