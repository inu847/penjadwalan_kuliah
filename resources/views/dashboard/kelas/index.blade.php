@extends('dashboard.layouts.main')

@section('content')
    <div class="pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3"><i class="fas fa-users"></i> Halaman Data Kelas</h1>
    </div>

    <div class="row">
        <div class="col-lg-6">Form</div>
        <div class="col-lg-6">
            <button type="button" class="btn btn-success" style="float: right;" data-bs-toggle="modal"
                data-bs-target="#kelasModal">
                <i class="fa fa-plus"></i> Tambah Data
            </button>
        </div>
    </div>
    <br>

    <!-- Modal Tambah -->
    <div class="modal fade" id="kelasModal" tabindex="-1" aria-labelledby="kelasModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="kelasModalLabel">Tambah Data Kelas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kelas.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_kelas" class="form-label">Kelas</label>
                            <input type="text" name="nama_kelas" class="form-control" id="nama_kelas" name="nama_kelas" required>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_mahasiswa" class="form-label">Jumlah Mahasiswa</label>
                            <input type="text" name="jumlah_mahasiswa" class="form-control" id="jumlah_mahasiswa" name="jumlah_mahasiswa" required>
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
                <th scope="col">Kelas</th>
                <th scope="col">Jumlah Mahasiswa</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php $count = 1; ?>
            @foreach ($semua_kelas as $kelas)
                <tr>
                    <td>{{ $count }}</td>
                    <td>{{ $kelas->nama_kelas }}</td>
                    <td>{{ $kelas->jumlah_mahasiswa }}</td>
                    <td>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#kelasEdit{{ $kelas->kode_kelas }}"
                            class="btn btn-warning"><i class="fa fa-edit"></i></button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#hapus{{ $kelas->kode_kelas }}Modal"
                            class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        {{-- <a href="/kelas/delete/{{ $kelas->kode_kelas }}" class="btn btn-danger"><i class="fa fa-trash"></i></a> --}}
                    </td>
                </tr>
                <?php $count++; ?>
            @endforeach
        </tbody>
    </table>

    @foreach ($semua_kelas as $kelas)
        <!-- Modal Edit -->
        <div class="modal fade" id="kelasEdit{{ $kelas->kode_kelas }}" tabindex="-1"
            aria-labelledby="kelasEdit{{ $kelas->kode_kelas }}Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="kelasEdit{{ $kelas->kode_kelas }}Label">Edit Data Kelas</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('kelas.update', [$kelas->kode_kelas]) }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="{{ $kelas->kode_kelas }}" name="kode_kelas">
                            <div class="mb-3">
                                <label for="nama_kelas" class="form-label">Kelas</label>
                                <input type="text" name="nama_kelas" class="form-control" id="nama_kelas"
                                    value="{{ $kelas->nama_kelas }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah_mahasiswa" class="form-label">Jumlah Mahasiswa</label>
                                <input type="text" name="jumlah_mahasiswa" class="form-control" id="jumlah_mahasiswa"
                                    value="{{ $kelas->jumlah_mahasiswa }}" required>
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
        <div class="modal fade" id="hapus{{ $kelas->kode_kelas }}Modal" tabindex="-1"
            aria-labelledby="hapus{{ $kelas->kode_kelas }}ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="hapus{{ $kelas->kode_kelas }}ModalLabel">Apakah Ingin Hapus Data
                            ?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger" onclick="$('#delete{{$kelas->kode_kelas}}').submit()">Hapus</button>
                        <form id="delete{{$kelas->kode_kelas}}" action='{{ route('kelas.destroy', [$kelas->kode_kelas]) }}' method='POST' enctype='multipart/form-data'>
                        @method('DELETE')
                        @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
