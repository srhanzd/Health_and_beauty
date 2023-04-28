<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $table='prescriptions';
    protected $fillable = [
        'AppointmentId',
        'Symptoms',
        'Diagnosis',
        'IsDeleted',
        'MedicalInfoId',
    ];
    public $timestamps=true;
    public function appointment()
    {
        return $this->belongsTo(Appointment::class,'AppointmentId','id');
    }
    public function medical_information()
    {
        return $this->belongsTo(MedicalInformation::class,'MedicalInfoId','id');
    }
    public function medicines()
    {
        return $this->hasMany(Medicine::class,'PrescriptionId','id');
    }
}
