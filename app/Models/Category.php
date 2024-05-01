<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $allowedIncludes = ['subcategories'];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function scopeIncluded(Builder $query)
    {
        if (!request()->has('included')) {
            return;
        }
        $includes = explode(',', request()->query('included'));
        $allowedIncludes = $this->allowedIncludes;
        $includes = array_filter($includes, function ($value) use ($allowedIncludes) {
            return in_array($value, $allowedIncludes);
        });
    
        // Si no hay campos permitidos en $includes, sal de la función
        if (empty($includes)) {
            return;
        }
        $query->with($includes);
    }
}
