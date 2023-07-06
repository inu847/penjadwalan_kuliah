<?php

namespace App\Http\Controllers;

use App\Models\Jam;
use App\Models\Kelas;
use App\Models\Pengampu;
use App\Models\Penjadwalan;
use App\Models\Ruang;
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
            6 => 'Sabtu',
        ];

        $jam = Jam::orderBy('start_time', 'asc')->get();

        // GENERATE HARI DAN JAM
        $genereateWaktu = array();
        foreach ($day as $key => $value) {
            foreach ($jam as $key2 => $value2) {
                $data_waktu = [
                    'day' => $value,
                    'start_time' => $value2->start_time,
                    'end_time' => $value2->end_time,
                    'matkul_id' => null,
                    'dosen_id' => null,
                    'kelas_id' => null,
                    'ruang_id' => null,
                ];

                $genereateWaktu[] = $data_waktu;
            }
        }

        // dd($genereateWaktu);

        // GENERATE JADWAL PENGAMPU
        $pengampu = Pengampu::get();
        $index_result_pengampu = 0;
        $max_pengampu = count($pengampu) - 1;

        // $kelas = Kelas::orderBy('nama_kelas', 'asc')->get();
        // $index_result_kelas = 0;
        // $max_kelas = count($kelas) - 1;
        
        $genereateJadwal = array();

        foreach ($genereateWaktu as $key => $value) {
            $data_jadwal = [
                'day' => $value['day'],
                'start_time' => $value['start_time'],
                'end_time' => $value['end_time'],
                'matkul_id' => $pengampu[$index_result_pengampu]->matkul_id,
                'dosen_id' => $pengampu[$index_result_pengampu]->dosen_id,
                'kelas_id' => $pengampu[$index_result_pengampu]->kelas_id,
                'ruang_id' => Ruang::where('kapasitas', '>=', $pengampu[$index_result_pengampu]->kelas->jumlah_mahasiswa)->first()->kode_ruang ?? null,
            ];

            $genereateJadwal[] = $data_jadwal;
            if ($index_result_pengampu < $max_pengampu) {
                $index_result_pengampu++;
            }else {
                $index_result_pengampu = 0;
            }

            // if ($index_result_kelas < $max_kelas) {
            //     $index_result_kelas++;
            // }else {
            //     $index_result_kelas = 0;
            // }
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
