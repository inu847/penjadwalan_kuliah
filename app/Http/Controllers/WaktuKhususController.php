<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jam;
use App\Models\WaktuKhusus;
use Illuminate\Http\Request;

class WaktuKhususController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dosen = Dosen::orderBy('nama_dosen', 'asc')->get();
        $day = [
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
        ];

        $jam = Jam::orderBy('start_time', 'asc')->get();
        $waktu_khusus = [];
        foreach ($jam as $key2 => $value2) {
            foreach ($day as $key => $value) {
                $data_waktu = [
                    'day' => $value,
                    'jam' => $value2->start_time . ' - ' . $value2->end_time,
                    'start_time' => $value2->start_time,
                    'end_time' => $value2->end_time,
                ];

                $waktu_khusus[] = $data_waktu;
            }
        }

        return view('dashboard.waktu_khusus.index', compact('dosen', 'day', 'waktu_khusus'));
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
        $data = $request->all();

        $waktu_khusus_check = WaktuKhusus::where('kode_dosen', $data['kode_dosen'])
            ->where('day', $data['day'])
            ->where('start_time', $data['start_time'])
            ->where('end_time', $data['end_time'])
            ->first();
        if ($waktu_khusus_check) {
            // UPDATE STATUS
            $waktu_khusus_check->update(['status' => $data['status']]);
            return response()->json(['status' => 'error', 'message' => 'Data sudah ada!']);
        }else{
            WaktuKhusus::create($data);
        }
        return response()->json(['status' => 'success', 'message' => 'Data berhasil ditambahkan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WaktuKhusus  $waktuKhusus
     * @return \Illuminate\Http\Response
     */
    public function show(WaktuKhusus $waktuKhusus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WaktuKhusus  $waktuKhusus
     * @return \Illuminate\Http\Response
     */
    public function edit(WaktuKhusus $waktuKhusus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WaktuKhusus  $waktuKhusus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WaktuKhusus $waktuKhusus)
    {
        $data = $request->all();

        $waktuKhusus->update($data);
        return redirect()->route('waktu_khusus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WaktuKhusus  $waktuKhusus
     * @return \Illuminate\Http\Response
     */
    public function destroy(WaktuKhusus $waktuKhusus)
    {
        $waktuKhusus->delete();
        return redirect()->route('waktu_khusus.index');
    }

    public function getDosenChecked(Request $request)
    {
        $data = $request->all();

        // ORDER BY DAY AND START TIME
        $waktu_khusus = WaktuKhusus::orderBy('day', 'asc')->orderBy('start_time', 'asc')->where('kode_dosen', $data['kode_dosen'])->get();

        if ($waktu_khusus) {
            return response()->json(['status' => 'success', 'data' => $waktu_khusus]);
        }else{
            return response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
        }
    }
}
