<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MPI extends Model
{
    protected $table = 'mpi';
    protected $guarded = [];

    public function getTRU() {
        return $this->hasMany(TRU::class,'mpi_id', 'id');
    }
}
