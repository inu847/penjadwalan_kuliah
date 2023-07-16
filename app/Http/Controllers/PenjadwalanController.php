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
        $pengampu = Pengampu::InRandomOrder()->get();
        $day = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
        ];

        foreach ($pengampu as $key => $value2) {
            // HITUNG JUMLAH PENGAMPU PADA DOSEN
            $check_pembagian_dosen_pengampu = Pengampu::where('dosen_id', $value2->dosen_id)->count();
            // BAGI DOSEN PENGAMPU KE BEBERAPA HARI DENGAN MIN 2 MAX 4 PER HARI
            // JIKA HASIL PEMBAGIAN KURANG DARI SAMA DENGAN 1 MAKA KURANGI PEMBAGIAN -1
            for ($i=0; $i < count($day); $i++) { 
                if ($check_pembagian_dosen_pengampu <= 1) {
                    $check_pembagian_dosen_pengampu = $check_pembagian_dosen_pengampu - (count($day) - 1);
                    // TAMBAHKAN PENGAMPU PADA INDEX TERAKHIR
                    $pengampu->push($value2);
                    // LANJUTKAN LOOPING SELANJUTNYA
                    continue;
                }
            }
        }
        // dd($pengampu);
        // CHECK JIKA PENGAPU DOSEN SAMA ADA 3 MAKA LETAKKAN PADA AWAL ARRAY DAN HAPUS SEBELUMNYA
        // foreach ($pengampu as $key => $value) {
        //     $check_pengampu_dosen = Pengampu::where('dosen_id', $value->dosen_id)->count();
        //     if ($check_pengampu_dosen == 3) {
        //         $pengampu->prepend($value);
        //         $pengampu->forget($key + 1);
        //     }
        // }
        // // dd($pengampu);
        // // DEFINISI ULANG INDEX BERURUT PADA ARRAY
        // $pengampu = $pengampu->values()->all();
        
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
        $start_time_new = Carbon::parse('08:40')->format('H:i');
        $end_time_new = Carbon::parse('09:30')->format('H:i');

        $start_time_friday = Carbon::parse('08:40')->format('H:i');
        $end_time_friday = Carbon::parse('09:30')->format('H:i');

        $sks_max = 16;
        $sks_min = 2;
        $waktu_per_sks = 50;

        // GENERATE JADWAL PENGAMPU
        $pengampu = $this->generatePengampu();
        $ruang = Ruang::get();
        $kelas = Kelas::get();
        $genereateJadwal = array();
        $index_pengampu = 0;
        $max_index_pengampu = count($pengampu) - 1;
        $max_kelas_per_hari = 3;
        $min_dosen_per_hari = 2;
        $max_dosen_per_hari = 4;
        $index_ruang = 0;
        $kelas_now = '';
        $count_kelas_now = 0;

        foreach ($day as $key => $value) {
            // RUANG
            $jenis_matkul = $pengampu[$index_pengampu]->matakuliah->jenis;
            $ruang_sesuai = Ruang::whereNotIn('jenis', ['Praktikum'])->get();
            $max_index_ruang = count($ruang_sesuai) - 1;
            // IF FRIDAY FIRST TIME UPDATE TIME
            if ($value == 'Jumat') {
                $start_time = $start_time_friday;
                $end_time = $end_time_friday;
            }
            foreach ($pengampu as $key2 => $value2) {     
                if ($pengampu[$index_pengampu]->kode_kelas == $kelas_now){
                    $count_kelas_now++;
                }else{
                    $kelas_now = $pengampu[$index_pengampu]->kode_kelas;
                    $count_kelas_now = 1;
                }

                if ($count_kelas_now > $max_kelas_per_hari) {
                    // CHECK IF TIME > END TIME RESET ON START TIME
                    if ($start_time >= $end_time) {
                        $start_time = Carbon::parse('07:00')->format('H:i');
                    }

                    $start_time_update = Carbon::parse($start_time);
                    $end_time_update = Carbon::parse($start_time)->addMinutes($waktu_per_sks * $pengampu[$index_pengampu]->matakuliah->sks);

                    if ($pengampu[$index_pengampu]->matakuliah->jenis == 'Praktikum') {
                        $ruang_sesuai_update = Ruang::where('jenis', 'Praktikum')->InRandomOrder()->first();
                    }else{
                        $ruang_sesuai_update = $ruang_sesuai[$index_ruang];
                    }

                    if ($value != 'Jumat'){
                        // STATMENT KBM END TIME
                        if ($end_time >= $start_time) {
                            $data_jadwal = [
                                'day' => $value,
                                'start_time' => $start_time_update,
                                'end_time' => $end_time_update,
                                'matkul_id' => $pengampu[$index_pengampu]->matkul_id,
                                'dosen_id' => $pengampu[$index_pengampu]->dosen_id,
                                'kelas_id' => $pengampu[$index_pengampu]->kelas_id,
                                'ruang_id' => $ruang_sesuai_update->kode_ruang,
                            ];
    
                            $kelas_now++;
        
                            $genereateJadwal[] = $data_jadwal;
                        }
                    }else if($value == 'Jumat' && $pengampu[$index_pengampu]->matakuliah->sks <= $sks_min){
                        if ($end_time_new > $start_time_new && $max_kelas_per_hari >= $kelas_now) {
                            $data_jadwal = [
                                'day' => $value,
                                'start_time' => $start_time_update,
                                'end_time' => $end_time_update,
                                'matkul_id' => $pengampu[$index_pengampu]->matkul_id,
                                'dosen_id' => $pengampu[$index_pengampu]->dosen_id,
                                'kelas_id' => $pengampu[$index_pengampu]->kelas_id,
                                'ruang_id' => $ruang_sesuai_update->kode_ruang,
                            ];
        
                            $genereateJadwal[] = $data_jadwal;
                        }
                    }

                    $start_time = Carbon::parse($start_time)->addMinutes($waktu_per_sks * $value2->matakuliah->sks)->format('H:i');
                    $start_time_new = Carbon::parse($start_time_new)->addMinutes($waktu_per_sks * $value2->matakuliah->sks)->format('H:i');
                    
                    if ($index_pengampu >= $max_index_pengampu) {
                        break;
                    }else{
                        $index_pengampu++;
                    }
                }

                if ($index_ruang >= $max_index_ruang) {
                    $index_ruang = 0;
                }else{
                    $index_ruang++;
                }
            }
            
            $start_time = Carbon::parse('07:00')->format('H:i');
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
