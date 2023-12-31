<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'categories';


    protected $fillable = [
        'nombre',
        'slug',
    ];

    public function commerces()
    {
        return $this->hasMany(Commerce::class, 'categoria');
    }

}