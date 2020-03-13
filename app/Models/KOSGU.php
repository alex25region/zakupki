<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KOSGU extends Model
{
    protected $table = 'z_kosgu';

    protected $guarded = [];

    public function getKODrashodov() {
        return $this->hasOne(KODRashodov::class,'id', 'kod_rashodov_id');

    }
}


