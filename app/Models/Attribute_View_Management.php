<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute_View_Management extends Model
{
    use HasFactory;
    protected $table='Attributes_View_Management';
    protected $fillable = [
        'Enable',
        'ClinicId',
        'StaticAttributeId',
        'DynamicAttributeId',
        'IsDeleted',

    ];
    public $timestamps=true;
    public function clinic()
    {
        return $this->belongsTo(Clinic::class,'ClinicId','id');
    }
    public function static_attribute()
    {
        return $this->belongsTo(StaticAttribute::class,'StaticAttributeId','id');
    }
    public function dynamic_attribute()
    {
        return $this->belongsTo(DynamicAttribute::class,'DynamicAttributeId','id');
    }


}
