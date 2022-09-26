<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    protected $table = 'divisi';

    protected $fillable = ['nama', 'parent'];

    public function users()
    {
        return $this->hasMany(\App\User::class);
    }

    public function saran()
    {
        return $this->hasMany(\App\Saran::class);
    }
}
