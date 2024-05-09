<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'status',
        'image_id',
    ];

    public function image()
    {
        return $this->hasOne(Image::class, 'image_id', 'id');
    }
}
