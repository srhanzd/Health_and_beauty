<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table='services';
    protected $fillable = [
        'ClinicId',
        'Name',
        'Description',
        'Step',
        'IsDeleted',
    ];
    public $timestamps=true;
    public function clinic()
    {
        return $this->belongsTo(Clinic::class,'ClinicId','id');
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class,'ServiceId','id');
    }
}
