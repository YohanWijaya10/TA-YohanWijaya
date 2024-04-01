<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SKU extends Model
{
    protected $fillable = ['sku'];

    // Menambahkan relasi one-to-many dengan pembelian
    public function pembelians()
    {
        return $this->hasMany(Pembelian::class, 'sku');
    }
}

