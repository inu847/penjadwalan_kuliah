@extends('dashboard.layouts.main')

@section('content')
    <div class="pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3"><i class="fas fa-users"></i> Halaman Data Penjadwalan</h1>
    </div>

    <div class="row">
        <div class="col-lg-6">Form</div>
        <div class="col-lg-6">
            <button type="button" class="btn btn-success" style="float: right;" data-bs-toggle="modal" data-bs-target="">
                <i class="fa fa-plus"></i> Tambah Data

            </button>
        </div>
    </div>
    <br>

    <table class="table table-striped table-hover">
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
                    <td>{{ $penjadwalan->kode_hari }}</td>
                    <td>{{ $penjadwalan->kode_jam }}</td>
                    <td>{{ $penjadwalan->kode_matkul }}</td>
                    <td>{{ $penjadwalan->kode_kelas }}</td>
                    <td>{{ $penjadwalan->kode_dosen }}</td>
                    <td>{{ $penjadwalan->kode_ruang }}</td>
                </tr>
                <?php $count++; ?>
            @endforeach
        </tbody>
    </table>
@endsection
