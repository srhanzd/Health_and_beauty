<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $table='patients';
    protected $fillable = [
        'UserId',
        'Birthdate',
        'Gender',
        'Address',
        'IsDeleted',
    ];
    public $timestamps=true;
    public function user()
    {
        return $this->belongsTo(User::class,'UserId','id');
    }
    public function dynamic_attributes_values()
    {
        return $this->hasMany(DynamicAttributeValue::class,'PatientId','id');
    }
}
