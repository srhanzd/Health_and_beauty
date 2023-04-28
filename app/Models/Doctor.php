<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $table='doctors';
    protected $fillable = [
        'UserId',
        'ClinicId',
        'Degree',
        'AboutMe',
        'Specialization',
        'IsDeleted',
        'IsHeadOfClinic',

    ];
    public $timestamps=true;
    /**
     * Get the user  record associated with the doctor.
     */
    public function user()
    {
        return $this->belongsTo(User::class,'UserId','id');
    }
    /**
     * Get the clinic  record associated with the doctor.
     */
    public function clinic()
    {
        return $this->belongsTo(Clinic::class,'ClinicId','id');
    }
    public function images()
    {
        return $this->hasMany(Image::class,'DoctorId','id');
    }
//    public function admins(){
//        return $this->hasMany(Admins::class,'DoctorId','id');->has one not many
//    }

}
