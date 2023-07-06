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

        // STATMENT KBM END TIME IN FRIDAY
        $start_time_new = Carbon::parse('08:40')->format('H:i');
        $end_time_new = Carbon::parse('09:30')->format('H:i');

        $sks_max = 16;
        $sks_min = 2;
        $waktu_per_sks = 50;

        // GENERATE JADWAL PENGAMPU
        $pengampu = Pengampu::InRandomOrder()->get();
        $genereateJadwal = array();

        foreach ($day as $key => $value) {
            foreach ($pengampu as $key2 => $value2) {
                if ($value != 'Jumat'){
                    // STATMENT KBM END TIME
                    if ($end_time >= $start_time) {
                        $data_jadwal = [
                            'day' => $value,
                            'start_time' => Carbon::parse($start_time),
                            'end_time' => Carbon::parse($start_time)->addMinutes($waktu_per_sks * $value2->matakuliah->sks),
                            'matkul_id' => $value2->matkul_id,
                            'dosen_id' => $value2->dosen_id,
                            'kelas_id' => $value2->kelas_id,
                            'ruang_id' => Ruang::where('kapasitas', '>=', $value2->kelas->jumlah_mahasiswa)->inRandomOrder()->first()->kode_ruang ?? null,
                        ];
            
                        $start_time = Carbon::parse($start_time)->addMinutes($waktu_per_sks * $value2->matakuliah->sks)->format('H:i');
    
                        array_push($genereateJadwal, $data_jadwal);
                    }
                }else if($value == 'Jumat' && $value2->matakuliah->sks <= $sks_min){
                    if ($end_time_new > $start_time_new) {
                        $data_jadwal = [
                            'day' => $value,
                            'start_time' => Carbon::parse($start_time_new),
                            'end_time' => Carbon::parse($start_time_new)->addMinutes($waktu_per_sks * $value2->matakuliah->sks),
                            'matkul_id' => $value2->matkul_id,
                            'dosen_id' => $value2->dosen_id,
                            'kelas_id' => $value2->kelas_id,
                            'ruang_id' => Ruang::where('kapasitas', '>=', $value2->kelas->jumlah_mahasiswa)->inRandomOrder()->first()->kode_ruang ?? null,
                        ];
            
                        $start_time_new = Carbon::parse($start_time_new)->addMinutes($waktu_per_sks * $value2->matakuliah->sks)->format('H:i');
    
                        array_push($genereateJadwal, $data_jadwal);
                    }
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
