<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Kelas; //memanggil class Model Kelas

use App\Http\Requests\KelasRequest; //memanggil class KelasRequest{}

use Session; //memanggil class Session{} untuk flash message

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas_list = Kelas::all();
        return view('kelas.index', compact('kelas_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\KelasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KelasRequest $request)
    {
        Kelas::create($request->all());
        Session::flash('flash_message', 'Data kelas berhasil disimpan.');
        return redirect('kelas');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Kelas $hobi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Kelas $hobi
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kelas)
    {
        return view('kelas.edit', compact('kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\KelasRequest  $request
     * @param  App\Kelas $hobi
     * @return \Illuminate\Http\Response
     */
    public function update(Kelas $kelas, KelasRequest $request)
    {
        $kelas->update($request->all());
        Session::flash('flash_message', 'Data kelas berhasil diupdate.');
        return redirect('kelas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Kelas $hobi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        Session::flash('flash_message', 'Data kelas berhasil dihapus.');
        Session::flash('penting', true);
        return redirect('kelas');
    }
}
