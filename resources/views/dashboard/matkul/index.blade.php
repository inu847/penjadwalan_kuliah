@extends('dashboard.layouts.main')

@section('content')
    <div class="pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3"><i class="fas fa-users"></i> Halaman Data Mata Kuliah</h1>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <form action="">
                <div class="mb-3 w-50">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Pilih dosen</option>
                        @foreach ($semua_matkul as $matkul)
                            <option value="{{ $matkul->kode_matkul }}">{{ $matkul->nama_matkul }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>


        <div class="col-lg-6">
            <button type="button" class="btn btn-success" style="float: right;" data-bs-toggle="modal"
                data-bs-target="#matkulModal">
                <i class="fa fa-plus"></i> Tambah Data
            </button>
        </div>
    </div>
    <br>

    <!-- Modal Tambah-->
    <div class="modal fade" id="matkulModal" tabindex="-1" aria-labelledby="matkulModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="matkulModalLabel">Tambah Data Mata Kuliah</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('matkul.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="kode_matkul" class="form-label">Kode Mata Kuliah</label>
                            <input type="text" class="form-control" id="kode_matkul" name="kode_matkul" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_matkul" class="form-label">Nama Mata Kuliah</label>
                            <input type="text" class="form-control" id="nama_matkul" name="nama_matkul" required>
                        </div>
                        <div class="mb-3">
                            <label for="sks" class="form-label">SKS</label>
                            <input type="number" class="form-control" id="sks" name="sks" required>
                        </div>
                        <div class="mb-3">
                            <label for="semester" class="form-label">Semester</label>
                            <input type="number" class="form-control" id="semester" name="semester" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis" class="form-label">Jenis</label>
                            <input type="text" class="form-control" id="jenis" name="jenis" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis" class="form-label">Kurikulum</label>
                            <input type="text" class="form-control" id="kurikulum" name="kurikulum" required>
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
                <th scope="col">Kode MK</th>
                <th scope="col">Nama Mata Kuliah</th>
                <th scope="col">SKS</th>
                <th scope="col">Semester</th>
                <th scope="col">Jenis</th>
                <th scope="col">Kurikulum</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php $count = 1; ?>
            @foreach ($semua_matkul as $matkul)
                <tr>
                    <td>{{ $count }}</td>
                    <td>{{ $matkul->kode_matkul }}</td>
                    <td>{{ $matkul->nama_matkul }}</td>
                    <td>{{ $matkul->sks }}</td>
                    <td>{{ $matkul->semester }}</td>
                    <td>{{ $matkul->jenis }}</td>
                    <td>{{ $matkul->kurikulum }}</td>
                    <td>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#matkulEdit{{ $matkul->kode_matkul }}"
                            class="btn btn-warning"><i class="fa fa-edit"></i></button>
                        <button type="button" data-bs-toggle="modal"
                            data-bs-target="#hapus{{ $matkul->kode_matkul }}Modal" class="btn btn-danger"><i
                                class="fa fa-trash"></i></button>
                        {{-- <a href="/matkul/delete/{{ $matkul->kode_matkul }}" class="btn btn-danger"><i class="fa fa-trash"></i></a> --}}
                    </td>
                </tr>
                <?php $count++; ?>
            @endforeach
        </tbody>
    </table>

    @foreach ($semua_matkul as $matkul)
        <!-- Modal Edit -->
        <div class="modal fade" id="matkulEdit{{ $matkul->kode_matkul }}" tabindex="-1"
            aria-labelledby="matkulEdit{{ $matkul->kode_matkul }}Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="matkulEdit{{ $matkul->kode_matkul }}Label">Edit Data Mata Kuliah
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('matkul.update', [$matkul->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="{{ $matkul->id }}" name="id">
                            <div class="mb-3">
                                <label for="kode_matkul" class="form-label">Kode Mata Kuliah</label>
                                <input type="text" name="kode_matkul" class="form-control" id="kode_matkul"
                                    value="{{ $matkul->kode_matkul }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama_matkul" class="form-label">Nama Mata Kuliah</label>
                                <input type="text" name="nama_matkul" class="form-control" id="nama_matkul"
                                    value="{{ $matkul->nama_matkul }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="sks" class="form-label">SKS</label>
                                <input type="number" name="sks" class="form-control" id="sks"
                                    value="{{ $matkul->sks }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="semester" class="form-label">Semester</label>
                                <input type="number" name="semester" class="form-control" id="semester"
                                    value="{{ $matkul->semester }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="jenis" class="form-label">Jenis</label>
                                <input type="text" name="jenis" class="form-control" id="jenis"
                                    value="{{ $matkul->jenis }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="jenis" class="form-label">Kurikulum</label>
                                <input type="text" name="kurikulum" class="form-control" id="Kurikulum"
                                    value="{{ $matkul->kurikulum }}" required>
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
        <div class="modal fade" id="hapus{{ $matkul->kode_matkul }}Modal" tabindex="-1"
            aria-labelledby="hapus{{ $matkul->kode_matkul }}ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="hapus{{ $matkul->kode_matkul }}ModalLabel">Apakah Ingin Hapus
                            Data ?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger" onclick="$('#delete{{$matkul->id}}').submit()">Hapus</button>
                        <form id="delete{{$matkul->id}}" action='{{ route('matkul.destroy', [$matkul->id]) }}' method='POST' enctype='multipart/form-data'>
                        @method('DELETE')
                        @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
