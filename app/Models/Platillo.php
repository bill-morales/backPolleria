<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class platillo extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price'];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}
