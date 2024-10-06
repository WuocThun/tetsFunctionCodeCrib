<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    use HasFactory;
    use HasFactory;

    public $timestamps = false;
    protected $table = 'blogs';
    protected $fillable
        = [
            'title',
            'customer_id',
            'nick_id',
            'total',
            'status',
        ];

    use HasFactory;
}
