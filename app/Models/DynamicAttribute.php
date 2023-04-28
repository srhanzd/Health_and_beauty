<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicAttribute extends Model
{
    use HasFactory;
    protected $table='Dynamic_Attributes';
    protected $fillable = [
        'Key',
        'DataTypeId',
        'Description',
        'ClinicId',
        'Required',
        'Disable',
        'DefaultValue',
        'IsHealthStandard',
        'IsDeleted',

    ];
    public $timestamps=true;
    public function clinic()
    {
        return $this->belongsTo(Clinic::class,'ClinicId','id');
    }
    public function data_type()
    {
        return $this->belongsTo(DataType::class,'DataTypeId','id');
    }
    public function dynamic_attributes_values()
    {
        return $this->hasMany(DynamicAttributeValue::class,'DynamicAttributeId','id');
    }
    public function attributes_view_management()
    {
        return $this->hasMany(Attribute_View_Management::class,'DynamicAttributeId','id');
    }
    public function dependencies()
    {
        return $this->hasMany(Dependency::class,'DynamicAttributeId','id');
    }
    public function validations()
    {
        return $this->hasMany(Validation::class,'DynamicAttributeId','id');
    }
    public function rules()
    {
        return $this->hasMany(Rule::class,'DynamicAttributeId','id');
    }
}
