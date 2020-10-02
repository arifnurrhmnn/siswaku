<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hobi extends Model
{
    protected $table = 'hobi';
    protected $fillable = ['nama_hobi'];

    public function siswa(){
        /**
         * belongsToMany = menghubungkan Hobi{} dengan Siswa{} dipandang dari sisi Hobi{} (many to many)
         * @param app\Siswa = menghubungkan dengan Siswa{}
         * @param hobi_siswa = nama tabel untuk penghubung (junction table)
         * @param id_hobi = nama kolom yg menjadi foreign key pd table hobi_siswa menghubungkan ke Hobi{}
         * @param id_siswa = nama kolom menjadi foreign key pd table hobi_siswa menghubungkan ke Siswa{}
         */
        return $this->belongsToMany('App\Siswa', 'hobi_siswa', 'id_hobi', 'id_siswa');
    }

}
