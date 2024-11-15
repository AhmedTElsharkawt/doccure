<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory; use SoftDeletes;

    protected $fillable = [
        'date',
        'time',
        'status',
        'user_id',
        'doctor_id'
    ];

    function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    function patient()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
