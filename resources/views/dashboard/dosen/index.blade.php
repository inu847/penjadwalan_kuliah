@extends('dashboard.layouts.main')

@section('content')
    <div class="pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3"><i class="fas fa-users"></i> Halaman Data Dosen</h1>
    </div>

    <div class="row">
        <div class="col-lg-6">Form</div>
        <div class="col-lg-6">
            <button type="button" class="btn btn-success" style="float: right;" data-bs-toggle="modal"
                data-bs-target="#dosenModal">
                <i class="fa fa-plus"></i> Tambah Data
            </button>
        </div>
    </div>
    <br>

    <!-- Modal Tambah -->
    <div class="modal fade" id="dosenModal" tabindex="-1" aria-labelledby="dosenModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="dosenModalLabel">Tambah Data Dosen</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dosen.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nidn" class="form-label">NIDN</label>
                            <input type="number" class="form-control" id="nidn" name="nidn" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_dosen" class="form-label">Nama Dosen</label>
                            <input type="text" class="form-control" id="nama_dosen" name='nama_dosen' required>
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

    <table id="table" class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">NIDN</th>
                <th scope="col">Nama Dosen</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php $count = 1; ?>
            @foreach ($semua_dosen as $dosen)
                <tr>
                    <td>{{ $count }}</td>
                    <td>{{ $dosen->nidn }}</td>
                    <td>{{ $dosen->nama_dosen }}</td>
                    <td>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#dosenEdit{{ $dosen->kode_dosen }}"
                            class="btn btn-warning"><i class="fa fa-edit"></i></button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#hapus{{ $dosen->kode_dosen }}Modal"
                            class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        {{-- <a href="/dosen/delete/{{ $dosen->kode_dosen }}" class="btn btn-danger"><i class="fa fa-trash"></i></a> --}}
                    </td>
                </tr>
                <?php $count++; ?>
            @endforeach
        </tbody>
    </table>

    @foreach ($semua_dosen as $dosen)
        <!-- Modal Edit -->
        <div class="modal fade" id="dosenEdit{{ $dosen->kode_dosen }}" tabindex="-1"
            aria-labelledby="dosenEdit{{ $dosen->kode_dosen }}Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="dosenEdit{{ $dosen->kode_dosen }}Label">Edit Data Dosen</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('dosen.update', [$dosen->kode_dosen]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="{{ $dosen->kode_dosen }}" name="kode_dosen">
                            <div class="mb-3">
                                <label for="nidn" class="form-label">NIDN</label>
                                <input type="number" name="nidn" class="form-control" id="nidn"
                                    value="{{ $dosen->nidn }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="nama_dosen" class="form-label">Nama Dosen</label>
                                <input type="text" name="nama_dosen" class="form-control" id="nama_dosen"
                                    value="{{ $dosen->nama_dosen }}" required>
                                <div id="dosen_list"></div>
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
        <div class="modal fade" id="hapus{{ $dosen->kode_dosen }}Modal" tabindex="-1"
            aria-labelledby="hapus{{ $dosen->kode_dosen }}ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="hapus{{ $dosen->kode_dosen }}ModalLabel">Apakah Ingin Hapus Data
                            ?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger" onclick="$('#delete{{$dosen->kode_dosen}}').submit()">Hapus</button>
                        <form id="delete{{$dosen->kode_dosen}}" action='{{ route('dosen.destroy', [$dosen->kode_dosen]) }}' method='POST' enctype='multipart/form-data'>
                        @method('DELETE')
                        @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
