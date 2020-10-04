<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; //Object Request

use App\Siswa; //Memanggila Class Model Siswa
Use App\Telepon; //memanggil class model Telepon
use App\Kelas; //memanggil class Model Kelas
use App\Hobi; //memanggil class Model Hobi 

use App\Http\Requests\SiswaRequest; //memanggil class SiswaRequest{}

use Storage; //memanggil class STorage{}

use Session; //memanggil class Session{} untuk flash message

class SiswaController extends Controller
{
    public function __construct() 
    {   
        /**
         * auth = melakukan authentcation
         * except = mengecualikan method untuk di authentication
         */
        $this->middleware('auth', ['except' => [
            'index',
            'show',
            'cari',
        ]]);
    }
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

        //Foto
        // if ($request->hasFile('foto')) { //jika pada SiswaRequest{} memilii file
        //     $foto = $request->file('foto'); //medapatkan instance dari file
        //     $ext = $foto->getClientOriginalExtension(); //mendapatkan ekstensi dari file
        //     if ($request->file('foto')->isValid()) { //jika proses upload berhasil
        //         $foto_name = date('YmdHis'). ".$ext"; //menambah nama file foto dengan date dan extensi
        //         $upload_path = 'fotoupload'; //path folder untuk menyimpan foto (siswaku/publik/fotoupload)
        //         $request->file('foto')->move($upload_path, $foto_name); //memindahkan file yang sudah diupload
        //         $input['foto'] = $foto_name; //menyimpan nama file baru ke kolom foto di table siswa dalam database
        //     }
        // }

        //Upload Foto
        if ($request->hasFile('foto')) { //jika pada SiswaRequest{} memilii file
            $input['foto'] = $this->uploadFoto($request); //menyimpan nama file baru ke kolom foto di table siswa dalam database
        }
        
        //menyimpan data siswa jika lolos validasi
        $siswa = Siswa::create($input); 

        //menimpan data teepon jika lolos validasi
        // if ($request->filled('nomor_telepon')) {
        //     //menjalankan kode dibawah jika nomer_telepon diisi
        //     $telepon = new Telepon; //membuat instance dari object Telepon{} jika user menginputkan nomor_telepon
        //     $telepon->nomor_telepon = $request->input('nomor_telepon'); //mengatur nilai atribut nomor_telepon, nilai didapat dari input form nomor_telepon
        //     $siswa->telepon()->save($telepon); //menyimpan data telepon
        // }

        //menyimpan data telepon jika lolos validasi
        if ($request->filled('nomor_telepon')) {
            $this->insertTelepon($siswa, $request);
        }
        
        //menyimpan data hobi jika lolos validasi
        $siswa->hobi()->attach($request->input('hobi_siswa')); //attach = menerima argument dari input hobi[]

        Session::flash('flash_message', 'Data siswa berhasil disimpan.');
        
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

        //Foto. Cek adakah foto?
        // if ($request->hasFile('foto')) {
            
        //     //hapus foto lama jika ada foto baru
        //     $exist = Storage::disk('foto')->exists($siswa->foto);
        //     if (isset($siswa->foto) && $exist) {
        //         $delete = Storage::disk('foto')->delete($siswa->foto);
        //     }

        //     //upload foto baru
        //     $foto = $request->file('foto');
        //     $ext = $foto->getClientOriginalExtension();
        //     if ($request->file('foto')->isValid()) {
        //         $foto_name = date('YmdHis');
        //         $upload_path = 'fotoupload';
        //         $request->file('foto')->move($upload_path, $foto_name);
        //         $input['foto'] = $foto_name;
        //     }
        // }

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

        //Upload Foto
        if ($request->hasFile('foto')) { //jika pada SiswaRequest{} memilii file
            $input['foto'] = $this->updateFoto($siswa, $request); //menyimpan nama file baru ke kolom foto di table siswa dalam database
        }
        
        //update data siswa jika lolos validasi
        $siswa->update($input);

        //update nomor telepon jika sebelumnya sudah ada nomor telepon
        // if ($siswa->telepon) {
        //     //jika telepon diisi, update
        //     if ($request->filled('nomor_telepon')) {
        //         $telepon = $siswa->telepon;
        //         $telepon->nomor_telepon = $request->input('nomor_telepon');
        //         $siswa->telepon()->save($telepon);
        //     }
        //     //jika telepon tidak diisi, hapus
        //     else {
        //         $siswa->telepon()->delete();
        //     }
        // }

        //buat entry baru, jika sebelumnya tidak ada nomor telepon
        // else {
        //     if ($request->filled('nomor_telepon')) {
        //         $telepon = new Telepon;
        //         $telepon->nomor_telepon = $request->input('nomor_telepon');
        //         $siswa->telepon()->save($telepon);
        //     }
        // }

        //Update telepon
        $this->updateTelepon($siswa, $request);

        //update data hobi di table hobi_siswa
        $siswa->hobi()->sync($request->input('hobi_siswa'));

        Session::flash('flash_message', 'Data siswa berhasil di update.');

        return redirect('siswa');
    }

    public function destroy(Siswa $siswa)
    {
        // $siswa = Siswa::findOrFail($id);

        //hapus foto kalo ada
        // $exist = Storage::disk('foto')->exists($siswa->foto);
        // if (isset($siswa->foto) && $exist) {
        //     $delete = Storage::disk('foto')->delete($siswa->foto);
        // }

        //hapus foto kalo ada
        $this->hapusFoto($siswa);

        //hapus data siswa
        $siswa->delete();

        Session::flash('flash_message', 'Data siswa berhasil dihapus.');
        Session::flash('penting', true);

        return redirect('siswa');
    }

    public function dateMutator()
    {
        $siswa = Siswa::findOrFail(1);
        return "Umur {$siswa->nama_siswa} adalah {$siswa->tanggal_lahir->age} tahun";
    }

    private function insertTelepon(Siswa $siswa, SiswaRequest $request) {
        $telepon = new Telepon; //membuat instance dari object Telepon{} jika user menginputkan nomor_telepon
        $telepon->nomor_telepon = $request->input('nomor_telepon'); //mengatur nilai atribut nomor_telepon, nilai didapat dari input form nomor_telepon
        $siswa->telepon()->save($telepon); //menyimpan data telepon
    }

    private function updateTelepon(Siswa $siswa, SiswaRequest $request){
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

        // buat entry baru, jika sebelumnya tidak ada nomor telepon
        else {
            if ($request->filled('nomor_telepon')) {
                $telepon = new Telepon;
                $telepon->nomor_telepon = $request->input('nomor_telepon');
                $siswa->telepon()->save($telepon);
            }
        }
    }

    private function uploadFoto(SiswaRequest $request) {
        $foto = $request->file('foto'); //medapatkan instance dari file
        $ext = $foto->getClientOriginalExtension(); //mendapatkan ekstensi dari file
    
        if ($request->file('foto')->isValid()) { //jika proses upload berhasil
            $foto_name = date('YmdHis'). ".$ext"; //menambah nama file foto dengan date dan extensi
            $upload_path = 'fotoupload'; //path folder untuk menyimpan foto (siswaku/publik/fotoupload)
            $request->file('foto')->move($upload_path, $foto_name); //memindahkan file yang sudah diupload
            return $foto_name; //menyimpan nama file baru ke kolom foto di table siswa dalam database
        }

        return false;
    }

    private function updateFoto(Siswa $siswa, SiswaRequest $request) {
        //jika user mengisi foto
        if ($request->hasFile('foto')) {
            
            //hapus foto lama jika ada foto baru
            $exist = Storage::disk('foto')->exists($siswa->foto);
            if (isset($siswa->foto) && $exist) {
                $delete = Storage::disk('foto')->delete($siswa->foto);
            }

            //upload foto baru
            $foto = $request->file('foto');
            $ext = $foto->getClientOriginalExtension();
            if ($request->file('foto')->isValid()) {
                $foto_name = date('YmdHis'). ".$ext";
                $upload_path = 'fotoupload';
                $request->file('foto')->move($upload_path, $foto_name);
                return $foto_name;
            }
        }
    }

    private function hapusFoto(Siswa $siswa) {
        $is_foto_exist = Storage::disk('foto')->exists($siswa->foto);

        if ($is_foto_exist) {
            $delete = Storage::disk('foto')->delete($siswa->foto);
        }
    }

    public function cari(Request $request) {
        $kata_kunci = trim($request->input('kata_kunci')); //mengambil nilai kata kunci dari form

        if (!empty($kata_kunci)) { //jika kata kunci tidak kosong
            $jenis_kelamin = $request->input('jenis_kelamin'); //mendapatkan jenis kelamin
            $id_kelas = $request->input('id_kelas'); //mendapatkan kelas

            //Query
            $query = Siswa::where('nama_siswa', 'LIKE', '%' . $kata_kunci . '%'); //query pencarian berdasarkan nama
            (!empty($jenis_kelamin)) ? $query->JenisKelamin($jenis_kelamin) : ''; //jika dropdown jenis_kelamin dipilih, tambahkan jenis_kelain pada query dari scopeJenisKelamin yg ada di Model Siswa
            (!empty($id_kelas)) ? $query->Kelas($id_kelas) : ''; //jika dropdown kelas dipilih, tambahkan id_kelas pada quer dari scopeKelas yg ada di Model Siswa
            $siswa_list = $query->paginate(2); //menampilkan 2 siswa per halaman

            //URL links pagination
            $pagination = (!empty($jenis_kelamin)) ? $siswa_list->appends(['jenis_kelamin' => $jenis_kelamin]) : ''; //jika dropdown jenis_kelamin dipilih, jalankan appends()
            $pagination = (!empty($id_kelas)) ? $siswa_list->appends(['id_kelas' => $id_kelas]) : ''; //jika dropdown kelas dipilih, jalankan appends()
            $pagination = $siswa_list->appends(['kata_kunci' => $kata_kunci]); //appends() = untuk menambahkan querystring pada url link

            $jumlah_siswa = $siswa_list->total(); //mencari jumlah hasil pencarian
            
            return view('siswa.index', compact('siswa_list', 'kata_kunci', 'pagination', 'jumlah_siswa', 'id_kelas', 'jenis_kelamin'));
        }

        return redirect('siswa'); //redirect jika kata kunci kosong
    }
}
