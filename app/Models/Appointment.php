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
        'ServiceId',
        'Date',
        'Time',
        'Status',
        'IsDeleted',
        'Notified',
    ];
    public $timestamps=true;
    public function patient()
    {
        return $this->belongsTo(Patient::class,'PatientId','id');
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'DoctorId','id');
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
