<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OBAS extends Model
{
    protected $table = 'z_obas';
    protected $guarded = [];

    public function getMPI() {
        return $this->hasOne(MPI::class,'id', 'mpi_id')->withDefault([ 'name' => 'Не указана МПИ' ]);
    }

    public function getTRU() {
        return $this->hasOne(TRU::class,'id', 'tru_id')->withDefault([ 'name' => 'Не указана ТРУ' ]);
    }

    public function getKOSGU() {
        return $this->hasOne(KOSGU::class,'id', 'kosgu_id');
    }

    public function getOKPD() {
        return $this->hasOne(OKPD::class,'id', 'okpd_id');
    }

}

