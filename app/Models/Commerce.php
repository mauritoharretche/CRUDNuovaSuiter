<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commerce extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'commerces';

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        // 'imagen',
        // 'categoria_asociada'
        'categoria'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categoria');
    }

}