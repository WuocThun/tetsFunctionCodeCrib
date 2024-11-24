<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'invoices';
    protected $fillable = [
        'motel_id',
        'new_electric',
        'old_electric',
        'new_water',
        'old_water',
        'electric_fee',
        'water_fee',
        'total_amount',
        'status',
        'money_water',
        'money_electric',
        'money',
        'money_another',
    ];
    public function motel()
    {
        return $this->belongsTo(Motel::class);
    }
}
