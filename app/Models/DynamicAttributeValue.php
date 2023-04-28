<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicAttributeValue extends Model
{
    use HasFactory;
    protected $table='Dynamic_Attribute_Values';
    protected $fillable = [
        'ValueString',
        'ValueDouble',
        'ValueDateTime',
        'ValueBoolean',
        'DynamicAttributeId',
        'Disable',
        'ClinicId',
        'PatientId',
        'IsDeleted',

    ];
    public $timestamps=true;
    public function dynamic_attribute()
    {
        return $this->belongsTo(DynamicAttribute::class,'DynamicAttributeId','id');
    }
    public function clinic()
    {
        return $this->belongsTo(Clinic::class,'ClinicId','id');
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class,'PatientId','id');
    }
}
