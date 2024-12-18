<?php

namespace App\Models;

use Database\Factories\SubcategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subcategory
{
/** @use HasFactory<SubcategoryFactory> */
    use HasFactory;

    protected  $fillable = ['name', 'photo'];

    public static function with(string $string)
    {
    }
}
