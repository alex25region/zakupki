<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OKPD extends Model
{
    protected $table = 'z_okpd';
    protected $guarded = [];

    public function getKODrashodov() {
        return $this->hasOne(KODRashodov::class,'id', 'kod_rashodov_id');

    }

}
