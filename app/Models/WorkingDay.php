<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingDay extends Model
{
    use HasFactory;
    protected $table='working_days';
    protected $fillable = [
        'Day',
        'Off',
        'IsDeleted',

    ];
    public $timestamps=true;
    public function doctor_working_hours()
    {
        return $this->hasMany(DoctorWorkingHour::class,'WorkingDaysId','id');
    }
    public function secretary_working_hours()
    {
        return $this->hasMany(SecretaryWorkingHour::class,'WorkingDaysId','id');
    }
    public function doctor_users(){
        return $this->belongsToMany(User::class,'doctor_working_hours');
    }
    public function secretary_users(){
        return $this->belongsToMany(User::class,'secretary_working_hours');
    }

}
