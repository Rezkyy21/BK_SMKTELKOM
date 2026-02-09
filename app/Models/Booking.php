<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



    class Booking extends Model {

    protected $table = "Booking";
    public function siswa() {
        return $this->belongsTo(Siswa::class);
    }

    public function jadwal() {
        return $this->belongsTo(Jadwal::class);
    }

    public function topik() {
        return $this->belongsTo(Topik::class);
    }

    public function laporan() {
        return $this->hasOne(Laporan::class);
    }
}


