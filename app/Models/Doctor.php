<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'major_id',
    ];

    public function major(){
        return $this->belongsTo(Major::class);
    }

    public function bookings(){
        return $this->hasMany(Booking::class);
    }
}
