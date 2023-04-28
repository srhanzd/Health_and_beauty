<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalInformation extends Model
{
    use HasFactory;
    protected $table='medical_informations';
    protected $fillable = [
        'PatientId',
        'Height',
        'BGroup',
        'Pulse',
//        'Allergy',
        'Weight',
        'BPressure',
        'Respiration',
        'Diet',
        'IsDeleted',
    ];
    public $timestamps=true;
    public function user()
    {
        return $this->belongsTo(User::class,'PatientId','id');
    }
    public function prescriptions()
    {
        return $this->hasMany(Prescription::class,'MedicalInfoId','id');
    }
    public function medicines()
    {
        return $this->hasMany(Medicine::class,'MedicalInfoId','id');
    }
    public function surgeries()
    {
        return $this->hasMany(Surgery::class,'MedicalInfoId','id');
    }
    public function immunizations()
    {
        return $this->hasMany(Immunization::class,'MedicalInfoId','id');
    }
    public function allergies()
    {
        return $this->hasMany(Allergy::class,'MedicalInfoId','id');
    }

}
