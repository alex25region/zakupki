<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OBAS extends Model
{
    protected $guarded = [];

    public function getMPI() {
        return $this->hasOne(MPI::class,'mpi_id', 'id');
    }

    public function getTRU() {
        return $this->hasOne(TRU::class,'tru_id', 'id');
    }

}

