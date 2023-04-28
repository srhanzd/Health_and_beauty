<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory;
    protected $table='clinics';
    protected $fillable = [
        'Name',
        'IsDeleted',

    ];
    public $timestamps=true;
    /**
     * Get the doctors  in the clinic.
     */
    public function doctors()
    {
        return $this->hasMany(Doctor::class,'ClinicId','id');
    }
    public function secretaries()
    {
        return $this->hasMany(Secretary::class,'ClinicId','id');
    }
    public function services()
    {
        return $this->hasMany(Service::class,'ClinicId','id');
    }
    public function images()
    {
        return $this->hasMany(Image::class,'ClinicId','id');
    }
    public function dynamic_attributes()
    {
        return $this->hasMany(DynamicAttribute::class,'ClinicId','id');
    }
    public function dynamic_attributes_values()
    {
        return $this->hasMany(DynamicAttributeValue::class,'ClinicId','id');
    }
    public function static_attributes()
    {
        return $this->hasMany(StaticAttribute::class,'ClinicId','id');
    }
    public function attributes_view_management()
    {
        return $this->hasMany(Attribute_View_Management::class,'ClinicId','id');
    }
    public function rules()
    {
        return $this->hasMany(Rule::class,'ClinicId','id');
    }
}
