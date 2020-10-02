<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telepon extends Model
{
    protected $table = 'telepon';
    protected $primaryKey = 'id_siswa'; //mendefinisikan kolom id_siswa sebagai primary key
    protected $fillable = ['id_siswa', 'nomor_telepon']; //mengatur kolom apa saja yang boleh diisi secara mass assigment

    /**
     * Menyatakan Relasi
     */ 
    public function siswa(){
        /**
         * belongsTo = menghubungkan Telepon{} dengan Siswa{} dipandang dari sisi Telepon{} (one to one)
         * @param App\Siswa = menghubungkan dengan Siswa{}
         * @param id_siswa = nama kolom menjadi foreign key pd table telepon menghubungkan ke Siswa{}
         */
        return $this->belongsTo('App\Siswa', 'id_siswa');
    }
}
