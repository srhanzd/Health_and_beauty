<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table='images';
    protected $fillable = [
        'ClinicId',
        'DoctorId',
        'LocalImage',
        'path',
        'IsDeleted',
    ];
    public $timestamps=true;
    public function clinic()
    {
        return $this->belongsTo(Clinic::class,'ClinicId','id');
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'DoctorId','id');
    }
}
