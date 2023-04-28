<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    protected $table='medicines';
    protected $fillable = [
        'PrescriptionId',
        'MedicalInfoId',
        'Name',
        'Description',
        'IsDeleted',
    ];
    public $timestamps=true;
    public function prescription()
    {
        return $this->belongsTo(Prescription::class,'PrescriptionId','id');
    }
    public function medical_information()
    {
        return $this->belongsTo(MedicalInformation::class,'MedicalInfoId','id');
    }
}
