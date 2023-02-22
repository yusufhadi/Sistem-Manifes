<?php

namespace App\Http\Controllers;

use App\Models\Penumpang;
use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PDF;


class TiketPenumpangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $tiket = Penumpang::orderBy('created_at', 'desc')->get();
        $jadwal = Jadwal::all();
        $query = Penumpang::query();
        $bulan = $request->input('bulan');

        if ($bulan) {
            $query->whereMonth('tgl_keberangkatan', $bulan);
        }

        $tiket = $query->orderBy('created_at', 'desc')->get();
        return view('dashboard.manifes-tiket', compact('tiket', 'jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jadwal = Jadwal::all();
        return view('dashboard.tiket-penumpang', compact('jadwal'));
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
            'tgl_keberangkatan' => 'required',
            'date_format:Y-m-d\TH:i:s',
            Rule::unique('tabel')->where(function ($query) use ($request) {
                return $query->where('jadwal', $request->jadwal);
            }),
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
            'tgl_keberangkatan' => $request->tgl_keberangkatan,
            'asal' => $request->asal,
            'tujuan' => $request->tujuan
        ]);

        return redirect('tiket-penumpang')->with('toast_success', 'Tiket Penumpang Berhasil Ditambahkan');
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
            'tgl_keberangkatan' => 'required',
            'date_format:Y-m-d\TH:i:s',
            Rule::unique('tabel')->where(function ($query) use ($request) {
                return $query->where('jadwal', $request->jadwal);
            }),
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
            'tgl_keberangkatan' => $request->tgl_keberangkatan,
            'asal' => $request->asal,
            'tujuan' => $request->tujuan
        ]);

        return redirect('daftar-manifes-penumpang')->with('toast_success', 'Tiket Penumpang Berhasil Diubah');
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

        return redirect('daftar-manifes-penumpang')->with('toast_success', 'Tiket Penumpang Berhasil Dihapus');
    }

    public function downloadPdf($id)
    {
        $penumpang = Penumpang::findOrFail($id);
        // dd($kendaraan);

        $pdf = PDF::loadview('dashboard/tiket-penumpang-pdf', ['penumpang' => $penumpang]);
        return $pdf->stream();
        // return $pdf->download('laporan-pegawai-pdf');
    }
}
