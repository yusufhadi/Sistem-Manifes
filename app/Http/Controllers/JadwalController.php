<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'jadwal' => 'required',
            'date_format:Y-m-d\TH:i:s',
            Rule::unique('tabel')->where(function ($query) use ($request) {
                return $query->where('jadwal', $request->jadwal);
            }),
        ]);

        $jadwal = Jadwal::create([
            'kapal' => $request->kapal,
            'jadwal' => $request->jadwal,
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
            'jadwal' => 'required',
            'date_format:Y-m-d\TH:i:s',
            Rule::unique('tabel')->where(function ($query) use ($request) {
                return $query->where('jadwal', $request->jadwal);
            }),
        ]);

        $jadwal = Jadwal::findOrFail($id);

        $jadwal->update([
            'kapal' => $request->kapal,
            'jadwal' => $request->jadwal,
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
