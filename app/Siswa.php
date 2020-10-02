<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa'; //membuat property $table

    //menentukan kolom yang bisa/boleh diisi
    protected $fillable = [
        'nisn',
        'nama_siswa',
        'tanggal_lahir',
        'jenis_kelamin',
        'id_kelas',
    ];

    protected $dates = ['tanggal_lahir'];

    public function telepon(){
        /**
         * hasOne = menghubungkan Siswa{} dengan Telepon{} dipandang dari sisi Siswa{} (one to one)
         * @param app\Telepon = menghubungkan dengan Telepon{}
         * @param id_siswa = nama kolom menjadi foreign key pd table telepon menghubungkan ke Siswa{}
         */
        return $this->hasOne('App\Telepon', 'id_siswa');
    }

    public function kelas(){
        /**
         * belongsTo = menghubungkan Siswa{} dengan Kelas{} dipandang dari sisi Siswa{} (one to Many)
         * @param app\Kelas = menghubungkan dengan Kelas{}
         * @param id_kelas = nama kolom menjadi foreign key pd table siswa menghubungkan ke Kelas{}
         */
        return $this->belongsTo('App\Kelas', 'id_kelas');
    }

    public function hobi(){
        /**
         * belongsToMany = menghubungkan siswa{} dengan Hobi{} dipandang dari sisi Siswa{} (many to many)
         * @param app\Hobi = menghubungkan dengan Hobi{}
         * @param hobi_siswa = nama tabel untuk penghubung (junction table)
         * @param id_siswa = nama kolom menjadi foreign key pd table hobi_siswa menghubungkan ke Siswa{}
         * @param id_hobi = nama kolom yg menjadi foreign key pd table hobi_siswa menghubungkan ke Hobi{}
         * withTimeStamps = agar proses create/update tidak error
         */
        return $this->belongsToMany('App\Hobi', 'hobi_siswa', 'id_siswa', 'id_hobi')->withTimeStamps();
    }

    /**
     * Fungsi Accessor
     * mengganti format data setelah data didapatkan dari database
     */
    public function getNamaSiswaAttribute($nama_siswa)
    {
        return ucwords($nama_siswa);
    }

    /**
     * Fungsi Accessor
     * mendapatkan id hobi yang dipilih siswa
     */
    public function getHobiSiswaAttribute(){
        /**
         * $this->hobi = mendapat collection dari Hobi{}
         * pluck('id') = mendapatkan id dari hobi dari siswa yang bersangkutan
         * toArray() = mengubah kumpulan id yang didapat ke array
         */
        return $this->hobi->pluck('id')->toArray();
    }


    /**
     * Mutator
     * mengganti format data sebelum data disimpan ke database
     */
    // public function setNamaSiswaAttribute($nama_siswa)
    // {
    //     return strtolower($nama_siswa);
    // }

    
}
