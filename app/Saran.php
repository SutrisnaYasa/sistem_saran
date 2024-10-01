<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saran extends Model
{
    protected $table = 'saran';

    // tambahan status dari bagus
    protected $fillable = ['topik_saran', 'saran', 'nama_pengirim', 'telepon', 'file_bukti', 'status', 'tindak_lanjut', 'divisi_id'];

    public function divisi()
    {
        return $this->belongsTo(\App\Divisi::class);
    }
}
