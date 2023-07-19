<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sepeda extends Model
{
    use HasFactory;
    protected $fillable = ['nama','harga','deskripsi','disewakan','merk_id'];

    function merk(){
        return $this->belongsTo(Merk::class, 'merk_id', 'id');
    }
}
