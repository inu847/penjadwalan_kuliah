<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Matkul;
use App\Models\Pengampu;
use Illuminate\Http\Request;

class PengampuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semua_pengampu = Pengampu::all();
        $matakuliah = Matkul::all();
        $dosen = Dosen::all();
        $kelas = Kelas::all();

        return view('dashboard.pengampu.index', compact('semua_pengampu', 'matakuliah', 'dosen', 'kelas'));
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

        Pengampu::create($data);
        return redirect()->route('pengampu.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengampu  $pengampu
     * @return \Illuminate\Http\Response
     */
    public function show(Pengampu $pengampu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengampu  $pengampu
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengampu $pengampu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengampu  $pengampu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengampu $pengampu)
    {
        $data = $request->all();

        $pengampu->update($data);
        return redirect()->route('pengampu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengampu  $pengampu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengampu $pengampu)
    {
        $pengampu->delete();
        return redirect()->route('pengampu.index');
    }
}
