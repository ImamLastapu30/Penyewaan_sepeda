<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merk extends Model
{
    use HasFactory;
    protected $fillable = ['nama','deskripsi','negara','dealer_id'];
    public $timestamps = false;

    function sepedas()
    {
        return $this->hasMany(Sepeda::class, 'merk_id', 'id');
    }
    function dealer()
    {
        return $this->hasMany(Dealer::class, 'id', 'dealer_id');
    }
}
