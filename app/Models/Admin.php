<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table='admins';
    protected $fillable = [
        'DoctorId',
        'IsDeleted',
    ];
    public $timestamps=true;
//    public function doctor()
//    {
//        return $this->belongsTo(Doctor::class,'DoctorId','id');
//    }
}
