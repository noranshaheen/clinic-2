<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'date',
        'doctor_id'
    ];

    public static $store_rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255'],
        'phone' => ['required', 'max:100', 'min:6'],
        'date' => ['required', 'date'],
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
