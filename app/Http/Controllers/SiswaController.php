<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; //Object Request

use App\Siswa; //Memanggila Class Model Siswa
Use App\Telepon; //memanggil class model Telepon
use App\Kelas; //memanggil class Model Kelas
use App\Hobi; //memanggil class Model Hobi 

use App\Http\Requests\SiswaRequest; //memanggil class SiswaRequest{}
// use Validator; //Memanggil class facade validator

class SiswaController extends Controller
{
    /**
     * all() = mengambil semua data
     * sortBy('nama_siswa') = mengurutkan data berdasarkan nama siswa secara asc
     * count() = mencari jumlah data
     */
    public function index()
    {
        $siswa_list = Siswa::orderBy('nama_siswa', 'asc')->paginate(3);
        $jumlah_siswa = Siswa::count();
        /*   $siswa_list = Siswa::all()->sortBy('nama_siswa'); //mendapatkan semua data dari class Siswa
        $jumlah_siswa = $siswa_list->count(); //mendapatkan jumlah data dari koleksi $siswa_list */
        return view('siswa.index', compact('siswa_list', 'jumlah_siswa'));
    }

    public function create()
    {
        // $list_kelas = Kelas::pluck('nama_kelas', 'id'); //mengambil data kelas (nama_kelas dan id)
        // $list_hobi = Hobi::pluck('nama_hobi', 'id'); //mengambil data hobi (nama_hobi dan id)

        // return view('siswa.create', compact('list_kelas', 'list_hobi'));
        return view('siswa.create');
    }

    /**
     * Menerima semua inputan form
     * Menerima argument berupa instance dari object Request
     * required = harus diisi
     */
    public function store(SiswaRequest $request) // (method injection) memasukkan onject Request ke method store()
    {
        /**
         * Menggunakan method eloquent create()
         * sometimes = validasi dilakukan jika kolom tidak kosong
         */
        $input = $request->all(); //menampung semua inputan dari form

        // $this->validate($request, [
        //     'nisn' => 'required|string|size:4|unique:siswa,nisn',
        //     'nama_siswa' => 'required|string|max:30',
        //     'tanggal_lahir' => 'required|date',
        //     'jenis_kelamin' => 'required|in:L,P',
        //     'nomor_telepon' => 'sometimes|numeric|digits_between:10,15|unique:telepon,nomor_telepon',
        //     'id_kelas' => 'required',
        // ]);

        // if ($validator->fails()) { //jika validasi gagal
        //     return redirect('siswa/create') //lakukan redirect
        //         ->withInput() //menampilkan inputan sebelumnya
        //         ->withErrors($validator); //menampilkan pesan error
        // }
        
        //menyimpan data siswa jika lolos validasi
        $siswa = Siswa::create($input); 

        //menimpan data teepon jika lolos validasi
        if ($request->filled('nomor_telepon')) {
            //menjalankan kode dibawah jika nomer_telepon diisi
            $telepon = new Telepon; //membuat instance dari object Telepon{} jika user menginputkan nomor_telepon
            $telepon->nomor_telepon = $request->input('nomor_telepon'); //mengatur nilai atribut nomor_telepon, nilai didapat dari input form nomor_telepon
            $siswa->telepon()->save($telepon); //menyimpan data telepon
        }
        
        //menyimpan data hobi jika lolos validasi
        $siswa->hobi()->attach($request->input('hobi_siswa')); //attach = menerima argument dari input hobi[]
        
        return redirect('siswa');
    }

    /**
     * Menampilkan Detail Siswa
     */
    public function show(Siswa $siswa)
    {
        // $siswa = Siswa::findOrFail($id); //mendapatkan data berdasarkan id
        return view('siswa.show', compact('siswa'));
    }

    public function edit(Siswa $siswa)
    {
        // $siswa = Siswa::findOrFail($id);

        if (!empty($siswa->telepon->nomor_telepon)) {
            $siswa->nomor_telepon = $siswa->telepon->nomor_telepon;
        }

        // $list_kelas = Kelas::pluck('nama_kelas', 'id');//mengambil data pilihan kelas (nama_kelas dan id)
        // $list_hobi = Hobi::pluck('nama_hobi', 'id');//mengambil data pilihan hobi (nama_hobi dan id)

        // return view('siswa.edit', compact('siswa', 'list_kelas', 'list_hobi'));
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Siswa $siswa, SiswaRequest $request)
    {
        // $siswa = Siswa::findOrFail($id);
        $input = $request->all();

        // $this->validate($request, [
        //     'nisn' => 'required|string|size:4|unique:siswa,nisn,' . $request->input('id'),
        //     'nama_siswa' => 'required|string|max:30',
        //     'tanggal_lahir' => 'required|date',
        //     'jenis_kelamin' => 'required|in:L,P',
        //     'nomor_telepon' => 'sometimes|nullable|numeric|digits_between:10,15|unique:telepon,nomor_telepon,' . $request->input('id') . ',id_siswa',
        //     'id_kelas' => 'required',
        // ]);

        // if ($validator->fails()) { //jika validasi gagal
        //     return redirect('siswa/' . $id . '/edit') //lakukan redirect
        //         ->withInput() //menampilkan inputan  sebelumnya
        //         ->withErrors($validator); //menampilkan pesan error
        // }
        
        //update data siswa jika lolos validasi
        $siswa->update($request->all());

        //update nomor telepon jika sebelumnya sudah ada nomor telepon
        if ($siswa->telepon) {
            //jika telepon diisi, update
            if ($request->filled('nomor_telepon')) {
                $telepon = $siswa->telepon;
                $telepon->nomor_telepon = $request->input('nomor_telepon');
                $siswa->telepon()->save($telepon);
            }
            //jika telepon tidak diisi, hapus
            else {
                $siswa->telepon()->delete();
            }
        }
        //buat entry baru, jika sebelumnya tidak ada nomor telepon
        else {
            if ($request->filled('nomor_telepon')) {
                $telepon = new Telepon;
                $telepon->nomor_telepon = $request->input('nomor_telepon');
                $siswa->telepon()->save($telepon);
            }
        }

        //update data hobi di table hobi_siswa
        $siswa->hobi()->sync($request->input('hobi_siswa'));

        return redirect('siswa');
    }

    public function destroy(Siswa $siswa)
    {
        // $siswa = Siswa::findOrFail($id);
        $siswa->delete();
        return redirect('siswa');
    }

    public function dateMutator()
    {
        $siswa = Siswa::findOrFail(1);
        return "Umur {$siswa->nama_siswa} adalah {$siswa->tanggal_lahir->age} tahun";
    }
}
