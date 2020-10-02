<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $fillable = ['nama_kelas'];

    public function siswa(){
        /**
         * hasMany = menghubungkan Kelas{} dengan Siswa{} dipandang dari sisi Kelas{} (one to many)
         * @param app\Siswa = menghubungkan dengan Siswa{}
         * @param id_kelas = nama kolom menjadi foreign key pd table siswa menghubungkan ke Kelas{}
         */
        return $this->hasMany('App\Siswa', 'id_kelas');
    }

}
