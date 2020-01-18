<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
    protected $table = 'pangkat';
    protected $primaryKey = 'id_pangkat';
    protected $fillable = [
        'nama_pangkat'
    ];
}
