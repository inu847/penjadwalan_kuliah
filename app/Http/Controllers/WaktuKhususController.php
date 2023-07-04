<?php

namespace App\Http\Controllers;

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
        $semua_waktukhusus = WaktuKhusus::all();
        $day = [
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
        ];
        $status = [
            1 => 'Tidak Hadir',
            2 => 'Hadir',
            3 => 'Libur',
            4 => 'Cuti',
            5 => 'Izin',
            6 => 'Sakit',
            7 => 'Alpa',
            8 => 'Terlambat',
            9 => 'Pulang Cepat',
            10 => 'Lembur',
            11 => 'Tugas Luar',
            12 => 'Lainya',
        ];

        foreach ($semua_waktukhusus as $key => $value) {
            $value['status_name'] = $status[$value['status']];
        }

        return view('dashboard.waktu_khusus.index', compact('semua_waktukhusus', 'day', 'status'));
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

        WaktuKhusus::create($data);
        return redirect()->route('waktu_khusus.index');
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
}
