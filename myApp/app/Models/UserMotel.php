<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMotel extends Model
{

    use HasFactory;

    protected $table = 'user_motel';
    public $timestamps = false;

    protected $fillable
        = [
            'motel_id',
            'name',
            'phone_number',
            'password',
        ];
    // app/Models/UserMotel.php
    public function motel()
    {
        return $this->belongsTo(Motel::class, 'motel_id');
    }

}
