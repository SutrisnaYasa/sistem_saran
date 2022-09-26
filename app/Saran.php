<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saran extends Model
{
    protected $table = 'saran';

    protected $fillable = ['topik_saran', 'saran', 'nama_pengirim', 'telepon', 'file_bukti', 'divisi_id'];

    public function divisi()
    {
        return $this->belongsTo(\App\Divisi::class);
    }
}
