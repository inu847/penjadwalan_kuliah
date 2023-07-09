@extends('dashboard.layouts.main')

@section('content')
    <div class="pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3"><i class="fas fa-users"></i> Halaman Data Jam</h1>
    </div>

    <div class="row">
        <div class="col-lg-6">Form</div>
        <div class="col-lg-6">
            <button type="button" class="btn btn-success" style="float: right;" data-bs-toggle="modal"
                data-bs-target="#jamModal">
                <i class="fa fa-plus"></i> Tambah Data
            </button>
        </div>
    </div>
    <br>

    <!-- Modal -->
    <div class="modal fade" id="jamModal" tabindex="-1" aria-labelledby="jamModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="jamModalLabel">Tambah Data jam</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('jam.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf
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
                <th scope="col">Mulai Jam</th>
                <th scope="col">Sampai Jam</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php $count = 1; ?>
            @foreach ($semua_jam as $jam)
                <tr>
                    <td>{{ $count }}</td>
                    <td>{{ $jam->start_time }}</td>
                    <td>{{ $jam->end_time }}</td>
                    <td>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#jamEdit{{ $jam->kode_jam }}"
                            class="btn btn-warning"><i class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-danger" onclick="$('#delete{{$jam->kode_jam}}').submit()"><i class="fas fa-trash"></i></button>
                            <form id="delete{{$jam->kode_jam}}" action='{{ route('jam.destroy', [$jam->kode_jam]) }}' method='POST' enctype='multipart/form-data'>
                            @method('DELETE')
                            @csrf
                            </form>
                    </td>
                </tr>
                <?php $count++; ?>
            @endforeach
        </tbody>
    </table>

    @foreach ($semua_jam as $jam)
        <!-- Modal Edit -->
        <div class="modal fade" id="jamEdit{{ $jam->kode_jam }}" tabindex="-1"
            aria-labelledby="jamEdit{{ $jam->kode_jam }}Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="jamEdit{{ $jam->kode_jam }}Label">Edit Data Jam</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('jam.update', [$jam->kode_jam]) }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="{{ $jam->kode_jam }}" name="kode_jam">
                            <div class="mb-3">
                                <label for="start_time" class="form-label">Mulai Jam</label>
                                <input type="time" name="start_time" value="{{ $jam->start_time }}" class="form-control" id="start_time"
                                    required>
                            </div>
    
                            <div class="mb-3">
                                <label for="end_time" class="form-label">Sampai Jam</label>
                                <input type="time" name="end_time" value="{{ $jam->end_time }}" class="form-control" id="end_time"
                                    required>
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
    @endforeach
@endsection
