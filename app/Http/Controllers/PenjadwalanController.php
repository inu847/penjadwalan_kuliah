<?php

namespace App\Http\Controllers;

use App\Models\Jam;
use App\Models\Kelas;
use App\Models\Pengampu;
use App\Models\Penjadwalan;
use App\Models\Ruang;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PenjadwalanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semua_penjadwalan = Penjadwalan::all();
        
        return view('dashboard.penjadwalan.index', compact('semua_penjadwalan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penjadwalan  $penjadwalan
     * @return \Illuminate\Http\Response
     */
    public function show(Penjadwalan $penjadwalan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penjadwalan  $penjadwalan
     * @return \Illuminate\Http\Response
     */
    public function edit(Penjadwalan $penjadwalan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penjadwalan  $penjadwalan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penjadwalan $penjadwalan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penjadwalan  $penjadwalan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penjadwalan $penjadwalan)
    {
        //
    }

    public function generatePengampu()
    {
        $pengampu = Pengampu::get()->groupBy('dosen_id');
        $min_dosen_per_hari = 2;
        $max_dosen_per_hari = 3;
        
        $result = [];
        $dosen_over = [];
        
        // dd($pengampu);

        // JIKA DATA DOSEN MELEBIHI MAX DOSEN PER HARI MAKA TAMBAHKAN ARRAY DENGAN INDEX YANG BERBEDA PADA AKHIR ARRAY
        foreach ($pengampu as $key => $value) {
            if (count($value) > $max_dosen_per_hari) {
                $dosen_over[] = $value;
                unset($pengampu[$key]);
            }
        }

        // dd($pengampu);
        // TAMBAHKAN DOSEN OVER KE DALAM ARRAY PENGAMPU DENGAN MAKSIMAL INDEX SETELAHNYA
        foreach ($dosen_over as $key => $value) {
            // JIKA HASIL BAGI DOSEN_ID GENAP MAKA BAGI SESUAI DENGAN MAX DOSEN PER HARI
            if ($key % 2 == 0) {
                // DAPATKAN JUMLAH BANYAK DATANYA JIKA MELEBIHI BATAS MAKA BAGI SESUAI DENGAN MAX DOSEN PER HARI DENGAN LOOPING SAMPAI DATA HABIS
                $count = count($value);
                $index = 0;
                while ($count > 0) {
                    $pengampu[] = $value->slice($index, $max_dosen_per_hari);
                    $index += $max_dosen_per_hari;
                    $count -= $max_dosen_per_hari;
                }
            }else{
                // DAPATKAN JUMLAH BANYAK DATANYA JIKA MELEBIHI BATAS MAKA BAGI SESUAI DENGAN MAX DOSEN PER HARI DENGAN LOOPING SAMPAI DATA HABIS
                $count = count($value);
                $index = 0;
                while ($count > 0) {
                    $pengampu[] = $value->slice($index, $min_dosen_per_hari);
                    $index += $min_dosen_per_hari;
                    $count -= $min_dosen_per_hari;
                }
            }
        }

        // dd($pengampu);
        // BUAT DATA PENGAMPU MENJADI RANDOM
        $pengampu = $pengampu->shuffle();
        // BUAT DATA MENJADI ARRAY 1 DIMENSION
        $pengampu = $pengampu->flatten();
        // dd($pengampu->pluck('dosen_id'));
        return $pengampu;
    }

    public function generateJadwal(Request $request)
    {
        $day = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
        ];
        
        $start_time = Carbon::parse('07:00')->format('H:i');
        $end_time = Carbon::parse('20:20')->format('H:i');

        // STATMENT KBM END TIME NEW
        $start_time_new = Carbon::parse('07:00')->format('H:i');
        $end_time_new = Carbon::parse('20:20')->format('H:i');

        $start_time_friday = Carbon::parse('08:40')->format('H:i');
        $end_time_friday = Carbon::parse('09:30')->format('H:i');

        $sks_max = 16;
        $sks_min = 2;
        $waktu_per_sks = 50;

        // GENERATE JADWAL PENGAMPU
        $pengampu = $this->generatePengampu();
        // $pengampu = Pengampu::InRandomOrder()->get();
        $ruang = Ruang::get();
        $kelas = Kelas::get();
        $genereateJadwal = array();
        $index_pengampu = 0;
        $index_day = 1;
        $max_index_day = count($day);
        $max_kelas_per_hari = 3;
        $index_ruang = 0;
        $kelas_now = '';
        $count_kelas_now = 0;

        // MINIMAL DOSEN PER HARI
        foreach ($pengampu as $key => $value2) {
            // RUANG
            $jenis_matkul = $value2->matakuliah->jenis;
            $ruang_sesuai = Ruang::whereNotIn('jenis', ['Praktikum'])->get();
            $max_index_ruang = count($ruang_sesuai) - 1;
            
            if ($value2->kode_kelas == $kelas_now){
                $count_kelas_now++;
            }else{
                $kelas_now = $value2->kode_kelas;
                $count_kelas_now = 1;
            }

            // CHECK IF TIME > END TIME RESET ON START TIME
            if ($start_time >= $end_time) {
                $start_time = Carbon::parse('07:00')->format('H:i');
                $index_day++;
            }
            
            // IF FRIDAY FIRST TIME UPDATE TIME
            if ($day[$index_day] == 'Kamis' && $start_time >= $end_time) {
                $start_time = $start_time_friday;
                $end_time = $end_time_friday;
                $index_day++;
            }
            
            $start_time_update = Carbon::parse($start_time);
            $end_time_update = Carbon::parse($start_time)->addMinutes($waktu_per_sks * $value2->matakuliah->sks);

            if ($value2->matakuliah->jenis == 'Praktikum') {
                $ruang_sesuai_update = Ruang::where('jenis', 'Praktikum')->InRandomOrder()->first();
            }else{
                $ruang_sesuai_update = $ruang_sesuai[$index_ruang];
            }

            // STATMENT KBM END TIME
            if ($end_time >= $start_time) {
                // JIKA DALAM 1 HARI KELAS > MAX KELAS PER HARI MAKA HAPUS PENGAMPU INDEX SEKARANG  DAN TAMBAHKAN KE INDEX TERAKHIR
                if ($count_kelas_now >= $max_kelas_per_hari) {
                    $pengampu->push($value2);
                    $pengampu->forget($key);
                    continue;
                }

                $data_jadwal = [
                    'day' => $day[$index_day],
                    'start_time' => $start_time_update,
                    'end_time' => $end_time_update,
                    'matkul_id' => $value2->matkul_id,
                    'dosen_id' => $value2->dosen_id,
                    'kelas_id' => $value2->kelas_id,
                    'ruang_id' => $ruang_sesuai_update->kode_ruang,
                ];

                $kelas_now++;
                $genereateJadwal[] = $data_jadwal;
            }

            $start_time = Carbon::parse($start_time)->addMinutes($waktu_per_sks * $value2->matakuliah->sks)->format('H:i');
            $start_time_new = Carbon::parse($start_time_new)->addMinutes($waktu_per_sks * $value2->matakuliah->sks)->format('H:i');

            if ($index_ruang >= $max_index_ruang) {
                $index_ruang = 0;
            }else{
                $index_ruang++;
            }

            if ($index_day >= $max_index_day) {
                $index_day = 1;
            }
        }

        // dd($genereateJadwal);

        foreach ($genereateJadwal as $key => $value) {
            $create = [
                'day' => $value['day'],
                'start_time' => $value['start_time'],
                'end_time' => $value['end_time'],
                'matkul_id' => $value['matkul_id'],
                'dosen_id' => $value['dosen_id'],
                'kelas_id' => $value['kelas_id'],
                'ruang_id' => $value['ruang_id'],
            ];
            Penjadwalan::create($create);
        }

        return redirect()->route('penjadwalan.index')->with('success', 'Berhasil generate jadwal');
    }

    public function clearAll()
    {
        Penjadwalan::truncate();

        return redirect()->route('penjadwalan.index')->with('success', 'Berhasil clear jadwal');
    }
}
