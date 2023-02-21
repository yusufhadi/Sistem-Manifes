<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwal = Jadwal::all();
        return view('dashboard.jadwal', compact('jadwal'));
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
        $this->validate($request, [
            'kapal' => 'required',
            'tgl_keberangkatan' => 'required',
            'jam_keberangkatan' => 'required'
        ]);

        $jadwal = Jadwal::create([
            'kapal' => $request->kapal,
            'tgl_keberangkatan' => $request->tgl_keberangkatan,
            'jam_keberangkatan' => $request->jam_keberangkatan
        ]);

        // dd($jadwal);

        return redirect('jadwal');
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
            'kapal' => 'required',
            'tgl_keberangkatan' => 'required',
            'jam_keberangkatan' => 'required',
        ]);

        $jadwal = Jadwal::findOrFail($id);

        $jadwal->update([
            'kapal' => $request->kapal,
            'tgl_keberangkatan' => $request->tgl_keberangkatan,
            'jam_keberangkatan' => $request->jam_keberangkatan
        ]);

        return redirect('jadwal');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $data = $jadwal->delete();

        return redirect('jadwal');
    }
}
