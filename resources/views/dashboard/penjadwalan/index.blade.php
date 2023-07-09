@extends('dashboard.layouts.main')

@section('content')
    <div class="pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3"><i class="fas fa-users"></i> Halaman Data Penjadwalan</h1>
    </div>

    <div class="row">
        <div class="col-lg-6">Form</div>
        <div class="col-lg-6">
            <button type="button" onclick="$('#generateJadwal').submit()" class="btn btn-success" style="float: right;" data-bs-toggle="modal" data-bs-target="">
                <i class="fa fa-plus"></i> Generate Jadwal
            </button>
            <button type="button" onclick="$('#clearData').submit()" class="btn btn-danger mr-2" style="float: right;" data-bs-toggle="modal" data-bs-target="">
                <i class="fa fa-trash"></i> Clear Data
            </button>

            <form id="clearData" action='{{ route('penjadwalan.clearAll') }}' method='POST' enctype='multipart/form-data'>
                @csrf
            </form>

            <form id="generateJadwal" action='{{ route('penjadwalan.generate') }}' method='POST' enctype='multipart/form-data'>
            @csrf
            </form>
        </div>
    </div>
    <br>

    <table id="table" class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Hari</th>
                <th scope="col">Jam</th>
                <th scope="col">Mata Kuliah</th>
                <th scope="col">SKS</th>
                <th scope="col">Semester</th>
                <th scope="col">Kelas</th>
                <th scope="col">Dosen</th>
                <th scope="col">Ruang</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php $count = 1; ?>
            @foreach ($semua_penjadwalan as $penjadwalan)
                <tr>
                    <td>{{ $count }}</td>
                    <td>{{ $penjadwalan->day }}</td>
                    <td>{{ $penjadwalan->start_time." - ".$penjadwalan->end_time }}</td>
                    <td>{{ $penjadwalan->matkul->nama_matkul ?? null }}</td>
                    <td>{{ $penjadwalan->matkul->sks ?? null }}</td>
                    <td>{{ $penjadwalan->matkul->semester ?? null }}</td>
                    <td>{{ $penjadwalan->kelas->nama_kelas ?? null }}</td>
                    <td>{{ $penjadwalan->dosen->nama_dosen ?? null }}</td>
                    <td>{{ $penjadwalan->ruang->nama_ruang }}</td>
                </tr>
                <?php $count++; ?>
            @endforeach
        </tbody>
    </table>
@endsection
