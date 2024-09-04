<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'name',
        'price',
        'qty',
        'barcode',
        'status',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
