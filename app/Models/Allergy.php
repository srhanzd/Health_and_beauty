<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allergy extends Model
{
    use HasFactory;
    protected $table='allergies';
    protected $fillable = [
       'MedicalInfoId',
        'Type',
        'AllergicTo',
        'Description',
        'IsDeleted',
    ];
    public $timestamps=true;

    public function medical_information()
    {
        return $this->belongsTo(MedicalInformation::class,'MedicalInfoId','id');
    }
}
