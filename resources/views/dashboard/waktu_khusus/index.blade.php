@extends('dashboard.layouts.main')

@section('content')
    <div class="pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3"><i class="fas fa-users"></i> Halaman Data Waktu Khusus</h1>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <form action="">
                <div class="mb-3 w-50">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Pilih dosen</option>
                        @foreach ($semua_waktukhusus as $waktu)
                            <option value="{{ $waktu->kode_dosen }}">{{ $waktu->nama_dosen }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-secondary">Simpan</button>
                </div>
            </form>
        </div>
        <div class="col-lg-6">
            <button type="button" class="btn btn-success" style="float: right;" data-bs-toggle="modal"
                data-bs-target="#createModal">
                <i class="fa fa-plus"></i> Tambah Data
            </button>
        </div>
    </div>
    <br>

    <!-- Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="matkulModalLabel">Tambah Data Waktu Khusus</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('waktu_khusus.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="day" class="form-label">Hari</label>
                            <select name="day" class="form-control select2" id="day" required>
                                <option value="" selected disabled>Pilih Opsi</option>
                                @foreach ($day as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="start_time" class="form-label">Mulai Jam</label>
                            <input type="time" name="start_time" class="form-control" id="start_time"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="end_time" class="form-label">Sampai Jam</label>
                            <input type="time" name="end_time" class="form-control" id="end_time"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-control select2" id="status" required>
                                <option value="" selected disabled>Pilih Opsi</option>
                                @foreach ($status as $key => $item)
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
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
                <th scope="col">Hari</th>
                <th scope="col">Mulai Jam</th>
                <th scope="col">Sampai Jam</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php $count = 1; ?>
            @foreach ($semua_waktukhusus as $waktukhusus)
                <tr>
                    <td>{{ $count }}</td>
                    <td>{{ $waktukhusus->day }}</td>
                    <td>{{ $waktukhusus->start_time }}</td>
                    <td>{{ $waktukhusus->end_time }}</td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                {{ $waktukhusus->status_name }}
                            </label>
                        </div>
                    </td>
                    <td>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#waktuKhususEdit{{ $waktu->kode_waktukhusus }}"
                            class="btn btn-warning"><i class="fa fa-edit"></i></button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#hapus{{ $waktu->kode_waktukhusus }}Modal"
                            class="btn btn-danger"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
                <?php $count++; ?>
            @endforeach
        </tbody>
    </table>

    @foreach ($semua_waktukhusus as $waktu)
        <!-- Modal Edit -->
        <div class="modal fade" id="waktuKhususEdit{{ $waktu->kode_waktukhusus }}" tabindex="-1"
            aria-labelledby="waktuKhususEdit{{ $waktu->kode_waktukhusus }}Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="waktuKhususEdit{{ $waktu->kode_waktukhusus }}Label">Edit Data Ruang</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('waktu_khusus.update', [$waktu->kode_waktukhusus]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="{{ $waktu->kode_waktukhusus }}" name="kode_waktukhusus">
                            <div class="mb-3">
                                <label for="day" class="form-label">Hari</label>
                                <select name="day" class="form-control select2" id="day" required>
                                    <option value="" selected disabled>Pilih Opsi</option>
                                    @foreach ($day as $item)
                                        <option value="{{ $item }}" {{ ($waktu->day == $item) ? 'selected' : '' }}>{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="start_time" class="form-label">Mulai Jam</label>
                                <input type="time" name="start_time" value="{{ $waktu->start_time }}" class="form-control" id="start_time"
                                    required>
                            </div>
    
                            <div class="mb-3">
                                <label for="end_time" class="form-label">Sampai Jam</label>
                                <input type="time" name="end_time" value="{{ $waktu->end_time }}" class="form-control" id="end_time"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-control select2" id="status" required>
                                    <option value="" selected disabled>Pilih Opsi</option>
                                    @foreach ($status as $key => $item)
                                        <option value="{{ $key }}" {{ ($waktu->status == $key) ? 'selected' : '' }}>{{ $item }}</option>
                                    @endforeach
                                </select>
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
        <div class="modal fade" id="hapus{{ $waktu->kode_waktukhusus }}Modal" tabindex="-1"
            aria-labelledby="hapus{{ $waktu->kode_waktukhusus }}ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="hapus{{ $waktu->kode_waktukhusus }}ModalLabel">Apakah Ingin Hapus Data
                            ?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger" onclick="$('#delete{{$waktu->kode_waktukhusus}}').submit()">Hapus</button>
                        <form id="delete{{$waktu->kode_waktukhusus}}" action='{{ route('waktu_khusus.destroy', [$waktu->kode_waktukhusus]) }}' method='POST' enctype='multipart/form-data'>
                        @method('DELETE')
                        @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
