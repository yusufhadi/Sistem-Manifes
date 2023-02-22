<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PDF;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jadwal = Jadwal::all();
        // $kendaraan = Kendaraan::orderBy('created_at', 'desc')->get();
        $query = Kendaraan::query();
        $bulan = $request->input('bulan');

        if ($bulan) {
            $query->whereMonth('tgl_keberangkatan', $bulan);
        }

        $kendaraan = $query->orderBy('created_at', 'desc')->get();
        return view('dashboard.manifes-kendaraan', compact('kendaraan', 'jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jadwal = Jadwal::all();
        return view('dashboard.tiket-kendaraan', compact('jadwal'));
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
            'golongan' => 'required',
            'tgl_keberangkatan' => 'required',
            'date_format:Y-m-d\TH:i:s',
            Rule::unique('tabel')->where(function ($query) use ($request) {
                return $query->where('jadwal', $request->jadwal);
            }),
        ]);

        $kendaraan = Kendaraan::create([
            'nama' => $request->nama,
            'plat' => $request->plat,
            'tiket' => $request->tiket,
            'barang' => $request->barang,
            'kendaraan' => $request->kendaraan,
            'golongan' => $request->golongan,
            'tgl_keberangkatan' => $request->tgl_keberangkatan
        ]);

        // dd($kendaraan);
        $jadwal = Jadwal::all();
        return view('dashboard.tiket-kendaraan', compact('jadwal'));
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
            'golongan' => 'required',
            'tgl_keberangkatan' => 'required',
            'date_format:Y-m-d\TH:i:s',
            Rule::unique('tabel')->where(function ($query) use ($request) {
                return $query->where('jadwal', $request->jadwal);
            }),
        ]);

        $kendaraan = Kendaraan::findOrFail($id);

        $kendaraan->update([
            'nama' => $request->nama,
            'plat' => $request->plat,
            'tiket' => $request->tiket,
            'barang' => $request->barang,
            'kendaraan' => $request->kendaraan,
            'golongan' => $request->golongan,
            'tgl_keberangkatan' => $request->tgl_keberangkatan
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
