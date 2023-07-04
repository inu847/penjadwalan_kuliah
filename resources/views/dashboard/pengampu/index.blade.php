@extends('dashboard.layouts.main')

@section('content')
    <div class="pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3"><i class="fas fa-users"></i> Halaman Data Pengampu</h1>
    </div>

    <div class="row">
        <div class="col-lg-6">Form</div>
        <div class="col-lg-6">
            <button type="button" class="btn btn-success" style="float: right;" data-bs-toggle="modal"
                data-bs-target="#pengampuModal">
                <i class="fa fa-plus"></i> Tambah Data
            </button>
        </div>
    </div>
    <br>

    <!-- Modal Tambah -->
    <div class="modal fade" id="pengampuModal" tabindex="-1" aria-labelledby="pengampuModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="pengampuModalLabel">Tambah Data Pengampu</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pengampu.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="matkul_id" class="form-label">Mata Kuliah</label>
                            <select name="matkul_id" id="matkul_id" class="form-control select2" required>
                                <option value="" selected disabled>Pilih Opsi</option>
                                @foreach ($matakuliah as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_matkul }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="dosen_id" class="form-label">Nama Dosen</label>
                            <select name="dosen_id" id="dosen_id" class="form-control select2" required>
                                <option value="" selected disabled>Pilih Opsi</option>
                                @foreach ($dosen as $item)
                                    <option value="{{ $item->kode_dosen }}">{{ $item->nidn." - ".$item->nama_dosen }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kelas_id" class="form-label">Kelas</label>
                            <select name="kelas_id" id="kelas_id" class="form-control select2" required>
                                <option value="" selected disabled>Pilih Opsi</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->kode_kelas }}">{{ $item->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tahun_akademik" class="form-label">Tahun Akademik</label>
                            <input type="text" class="form-control" id="tahun_akademik" name="tahun_akademik" required>
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
                <th scope="col">Mata Kuliah</th>
                <th scope="col">Nama Dosen</th>
                <th scope="col">Kelas</th>
                <th scope="col">Tahun Akademik</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php $count = 1; ?>
            @foreach ($semua_pengampu as $pengampu)
                <tr>
                    <td>{{ $count }}</td>
                    <td>{{ $pengampu->matakuliah->nama_matkul ?? null }}</td>
                    <td>{{ ($pengampu->dosen->nidn ?? null)." - ".($pengampu->dosen->nama_dosen ?? null) }}</td>
                    <td>{{ $pengampu->kelas->nama_kelas ?? null }}</td>
                    <td>{{ $pengampu->tahun_akademik }}</td>
                    <td>
                        <button type="button" data-bs-toggle="modal"
                            data-bs-target="#pengampuEdit{{ $pengampu->kode_pengampu }}" class="btn btn-warning"><i
                                class="fa fa-edit"></i></button>
                        <button type="button" data-bs-toggle="modal"
                            data-bs-target="#hapus{{ $pengampu->kode_pengampu }}Modal" class="btn btn-danger"><i
                                class="fa fa-trash"></i></button>
                        {{-- <a href="/pengampu/delete/{{ $pengampu->kode_pengampu }}" class="btn btn-danger"><i class="fa fa-trash"></i></a> --}}
                    </td>
                </tr>
                <?php $count++; ?>
            @endforeach
        </tbody>
    </table>

    @foreach ($semua_pengampu as $pengampu)
        <!-- Modal Edit -->
        <div class="modal fade" id="pengampuEdit{{ $pengampu->kode_pengampu }}" tabindex="-1"
            aria-labelledby="pengampuEdit{{ $pengampu->kode_pengampu }}Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="pengampuEdit{{ $pengampu->kode_pengampu }}Label">Edit Data Pengampu
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('pengampu.update', [$pengampu->kode_pengampu]) }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="{{ $pengampu->kode_pengampu }}" name="kode_pengampu">
                            <div class="mb-3">
                                <label for="matkul_id" class="form-label">Mata Kuliah</label>
                                <select name="matkul_id" id="matkul_id" class="form-control select2" required>
                                    <option value="" selected disabled>Pilih Opsi</option>
                                    @foreach ($matakuliah as $item)
                                        <option value="{{ $item->id }}" {{ ($pengampu->matkul_id == $item->id) ? 'selected' : '' }}>{{ $item->nama_matkul }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="dosen_id" class="form-label">Nama Dosen</label>
                                <select name="dosen_id" id="dosen_id" class="form-control select2" required>
                                    <option value="" selected disabled>Pilih Opsi</option>
                                    @foreach ($dosen as $item)
                                        <option value="{{ $item->kode_dosen }}" {{ ($pengampu->dosen_id == $item->kode_dosen) ? 'selected' : '' }}>{{ $item->nidn." - ".$item->nama_dosen }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="kelas_id" class="form-label">Kelas</label>
                                <select name="kelas_id" id="kelas_id" class="form-control select2" required>
                                    <option value="" selected disabled>Pilih Opsi</option>
                                    @foreach ($kelas as $item)
                                        <option value="{{ $item->kode_kelas }}" {{ ($pengampu->kelas_id == $item->kode_kelas) ? 'selected' : '' }}>{{ $item->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tahun_akademik" class="form-label">Tahun Akademik</label>
                                <input type="text" name="tahun_akademik" class="form-control" id="tahun_akademik"
                                    value="{{ $pengampu->tahun_akademik }}" required>
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
        <div class="modal fade" id="hapus{{ $pengampu->kode_pengampu }}Modal" tabindex="-1"
            aria-labelledby="hapus{{ $pengampu->kode_pengampu }}ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="hapus{{ $pengampu->kode_pengampu }}ModalLabel">Apakah Ingin
                            Hapus Data ?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger" onclick="$('#delete{{$pengampu->kode_pengampu}}').submit()">Hapus</button>
                        <form id="delete{{$pengampu->kode_pengampu}}" action='{{ route('pengampu.destroy', [$pengampu->kode_pengampu]) }}' method='POST' enctype='multipart/form-data'>
                        @method('DELETE')
                        @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
