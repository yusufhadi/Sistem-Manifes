<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use PDF;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kendaraan = Kendaraan::orderBy('created_at', 'desc')->get();
        return view('dashboard.manifes-kendaraan', compact('kendaraan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.tiket-kendaraan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'plat' => 'required',
            'tiket' => 'required',
            'barang' => 'required',
            'kendaraan' => 'required',
            'golongan' => 'required'
        ]);

        $kendaraan = Kendaraan::create([
            'nama' => $request->nama,
            'plat' => $request->plat,
            'tiket' => $request->tiket,
            'barang' => $request->barang,
            'kendaraan' => $request->kendaraan,
            'golongan' => $request->golongan
        ]);

        // dd($kendaraan);

        return view('dashboard.tiket-kendaraan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'plat' => 'required',
            'tiket' => 'required',
            'barang' => 'required',
            'kendaraan' => 'required',
            'golongan' => 'required'
        ]);

        $kendaraan = Kendaraan::findOrFail($id);

        $kendaraan->update([
            'nama' => $request->nama,
            'plat' => $request->plat,
            'tiket' => $request->tiket,
            'barang' => $request->barang,
            'kendaraan' => $request->kendaraan,
            'golongan' => $request->golongan
        ]);

        return redirect('daftar-manifes-kendaraan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        $data = $kendaraan->delete();

        return redirect('daftar-manifes-kendaraan');
    }

    public function downloadPdf($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        // dd($kendaraan);

        $pdf = PDF::loadview('dashboard/tiket-kendaraan-pdf', ['kendaraan' => $kendaraan]);
        return $pdf->stream();
    }
}
