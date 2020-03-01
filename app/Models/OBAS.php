<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OBAS extends Model
{
    protected $table = 'obas';
    protected $guarded = [];

//    public function getMPI() {
//        return $this->hasOne(MPI::class,'id', 'mpi_id')->withDefault([ 'mpi_id' => 'Не указан МПИ' ]);
//    }
//
//    public function getTRU() {
//        return $this->hasOne(TRU::class,'id', 'tru_id')->withDefault([ 'tru_id' => 'Не указан ТРУ' ]);
//    }

    public function getMPI() {
        return $this->hasOne(MPI::class,'id', 'mpi_id')->withDefault([ 'name' => 'Не указана МПИ' ]);
    }

    public function getTRU() {
        return $this->hasOne(TRU::class,'id', 'tru_id')->withDefault([ 'name' => 'Не указана МПИ' ]);
    }

}

