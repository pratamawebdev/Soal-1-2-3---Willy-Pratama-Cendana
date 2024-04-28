<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stokBarang extends Model
{
    use HasFactory;
    protected $table='stok_barangs';
    protected $guarded=['id'];
}
