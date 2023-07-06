@extends('dashboard.layouts.main')

@section('content')
    <div class="pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3"><i class="fas fa-users"></i> Halaman Data Waktu Khusus</h1>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <form action="">
                <div class="mb-3 w-50">
                    <select class="form-select" id="kodeDosen" aria-label="Default select example">
                        <option selected>Pilih Dosen</option>
                        @foreach ($dosen as $waktu)
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
    {{-- <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
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
    </div> --}}

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Hari</th>
                <th scope="col">Jam</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php $count = 1; ?>
            @foreach ($waktu_khusus as $key => $waktukhusus)
                <tr>
                    <td>{{ $count }}</td>
                    <td>{{ $waktukhusus['day'] }}</td>
                    <td>{{ $waktukhusus['jam'] }}</td>
                    <td>
                        <div class="form-check">
                            <input type="hidden" name="kode_dosen" id="kode_dosen">
                            
                            <input class="form-check-input status{{ $key }}" id="status" type="checkbox" 
                                    data-day="{{ $waktukhusus['day'] }}"
                                    data-start_time="{{ $waktukhusus['start_time'] }}"
                                    data-end_time="{{ $waktukhusus['end_time'] }}"
                                    value="1" id="flexCheckDefault"
                                    
                                    >
                            <label class="form-check-label" for="flexCheckDefault">
                                Tidak Tersedia
                            </label>
                        </div>
                    </td>
                </tr>
                <?php $count++; ?>
            @endforeach
        </tbody>
    </table>

    <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
    {{-- SWAL --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // GETTING VALUE kodeDosen AND SET VALUE IN ID KODE_DOSEN
        $(document).ready(function() {
            $('#kodeDosen').change(function() {
                var kodeDosen = $(this).val();
                $('#kode_dosen').val(kodeDosen);

                // CHECKBOX CHECKED IF STATUS = 1 AND KODE_DOSEN = kodeDosen
                var kodeDosen = $('#kode_dosen').val();
                $.ajax({
                    url: "{{ route('waktu_khusus.getDosenChecked') }}",
                    type: "GET",
                    data: {
                        kode_dosen: kodeDosen,
                    },
                    success: function(data) {
                        $.each(data.data, function(key, value) {
                            console.log(value);
                            // IF STATUS = 1 CHEKED THE CHECKBOX CONTEXT IN DAY, START_TIME, END_TIME
                            if (value.status == 1) {
                                console.log(value.day+", "+value.start_time+" - "+value.end_time);
                                $('.status'+key).prop('checked', true);
                            }else{
                                $('.status'+key).prop('checked', false);
                            }
                        });

                        if (data.data.length == 0) {
                            var indexData = '{{ count($waktu_khusus) }}';
                            // LOOPING FOR UNCHECKED
                            for (let index = 0; index < indexData; index++) {
                                $('.status'+index).prop('checked', false);
                            }
                        }

                    }
                });
            });
        });

        $(document).on('change', '#status', function() {
            var kodeDosen = $('#kode_dosen').val();
            if (kodeDosen == '') {
                alert('Pilih Dosen Terlebih Dahulu');
                $(this).prop('checked', false);
                return false;
            } else {
                if ($(this).is(':checked')) {
                    var status = 1;
                } else {
                    var status = 0;
                }
            }
            // MAKE DATA SET
            var day = $(this).data('day');
            var start_time = $(this).data('start_time');
            var end_time = $(this).data('end_time');

            $.ajax({
                url: "{{ route('waktu_khusus.store') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    kode_dosen: kodeDosen,
                    day: day,
                    start_time: start_time,
                    end_time: end_time,
                    status: status,
                },
                success: function(data) {
                    // WITH SWAL
                    Swal.fire({
                        title: 'Berhasil',
                        text: data.message,
                        icon: 'success',
                        confirmButtonText: 'Oke'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                }
            });
        });
        
    </script>
@endsection
