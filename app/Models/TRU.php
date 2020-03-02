<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TRU extends Model
{
    protected $table = 'z_tru';
    protected $guarded = [];

    public function getMPIfromTRU() {
        return $this->hasOne(MPI::class, 'id', 'mpi_id');
    }
}
