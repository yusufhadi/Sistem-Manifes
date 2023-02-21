<?php

namespace App\Http\Controllers;

use App\Models\Penumpang;
use Illuminate\Http\Request;
use PDF;

class TiketPenumpangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiket = Penumpang::orderBy('created_at', 'desc')->get();
        return view('dashboard.manifes-tiket', compact('tiket'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.tiket-penumpang');
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
            'noHp' => 'required',
            'usia' => 'required',
            'jk' => 'required',
            'golongan' => 'required',
            'harga' => 'required',
            'tanggal' => 'required',
            'asal' => 'required',
            'tujuan' => 'required'
        ]);

        $penumpang = Penumpang::create([
            'nama' => $request->nama,
            'noHp' => $request->noHp,
            'usia' => $request->usia,
            'jk' => $request->jk,
            'golongan' => $request->golongan,
            'harga' => $request->harga,
            'tanggal' => $request->tanggal,
            'asal' => $request->asal,
            'tujuan' => $request->tujuan
        ]);

        return redirect('tiket-penumpang');
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
            'noHp' => 'required',
            'usia' => 'required',
            'jk' => 'required',
            'golongan' => 'required',
            'harga' => 'required',
            'tanggal' => 'required',
            'asal' => 'required',
            'tujuan' => 'required'
        ]);

        $penumpang = Penumpang::findOrFail($id);

        $penumpang->update([
            'nama' => $request->nama,
            'noHp' => $request->noHp,
            'usia' => $request->usia,
            'jk' => $request->jk,
            'golongan' => $request->golongan,
            'harga' => $request->harga,
            'tanggal' => $request->tanggal,
            'asal' => $request->asal,
            'tujuan' => $request->tujuan
        ]);

        return redirect('daftar-manifes-penumpang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tiket = Penumpang::findOrFail($id);

        $data = $tiket->delete();

        return redirect('daftar-manifes-penumpang');
    }

    public function downloadPdf($id)
    {
        $penumpang = Penumpang::findOrFail($id);
        // dd($kendaraan);

        $pdf = PDF::loadview('dashboard/tiket-penumpang-pdf', ['penumpang' => $penumpang]);
        return $pdf->stream();
    }
}
