<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motel extends Model
{

    use HasFactory;

    public $timestamps = false;
    protected $table = 'motel';

    protected $fillable
        = [
            'user_id',
            'slug',
            'name',
            'money',
            'default_electric',
            'default_water',
            'money_water',
            'money_electric',
            'money_wifi',
            'money_another',
            'money_date',
            'kind_motel',
            'status',
            'password',
            'total_member',
        ];
    public function users()
    {
        return $this->hasMany(UserMotel::class, 'motel_id');
    }
}
