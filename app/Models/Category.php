<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $guarded = [
        'id'
    ];

    //1 Category -> N Product
    public function Product()
    {

        return $this->hasMany(Product::class);
    }

}
