<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Immunization extends Model
{
    use HasFactory;
    protected $table='immunizations';
    protected $fillable = [
        'MedicalInfoId',
        'Name',
        'Description',
        'Date',
        'IsDeleted',
    ];
    public $timestamps=true;
    public function medical_information()
    {
        return $this->belongsTo(MedicalInformation::class,'MedicalInfoId','id');
    }
}
