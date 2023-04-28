<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $table='appointments';
    protected $fillable = [
        'PatientId',
        'DoctorId',
        'Date',
        'Time',
        'Status',
        'IsDeleted',
        'Notified',
    ];
    public $timestamps=true;
    public function user_patient()
    {
        return $this->belongsTo(User::class,'PatientId','id');
    }
    public function user_doctor()
    {
        return $this->belongsTo(User::class,'DoctorId','id');
    }
    public function service()
    {
        return $this->belongsTo(Service::class,'ServiceId','id');
    }
    public function prescriptions()
    {
        return $this->hasMany(Prescription::class,'AppointmentId','id');
    }
}
