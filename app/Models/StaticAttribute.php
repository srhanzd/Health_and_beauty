<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaticAttribute extends Model
{
    use HasFactory;
    protected $table='Static_Attributes';
    protected $fillable = [
        'Key',
        'Label',
        'ClinicId',
        'Description',
        'Required',
        'enable',
        'DataTypeId',
        'IsDeleted',

    ];
    public $timestamps=true;
    public function clinic()
    {
        return $this->belongsTo(Clinic::class,'ClinicId','id');
    }
    public function datatype()
    {
        return $this->belongsTo(DataType::class,'DataTypeId','id');
    }
    public function attributes_view_management()
    {
        return $this->hasMany(Attribute_View_Management::class,'StaticAttributeId','id');
    }
    public function rules()
    {
        return $this->hasMany(Rule::class,'StaticAttributeId','id');
    }
}
