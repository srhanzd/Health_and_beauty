<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'phone_number',
        'telephone_number',
        'IsDeleted',
        'email',
        'password',
        'blocked_date',
    ];

    public  function scopeFilter($query,array $filters)
    {
        $query->when($filters['search_query'] ?? false, function ($query, $search) {
            $query->where('first_name', 'like', '%' . $search . "%")
                ->orWhere('last_name','like','%'.$search."%");

        });
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        //'remember_token',
    ];
    public $timestamps=true;


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
//        'email_verified_at' => 'datetime',
        'blocked_date'=>'datetime'
    ];
    protected $dates=['blocked_date'];
    /**
     * Get the doctor record associated with the user.
     */
    public function doctor()
    {
        return $this->hasOne(Doctor::class,'UserId','id');
    }
    public function patient()
    {
        return $this->hasOne(Patient::class,'UserId','id');
    }
    public function secretary()
    {
        return $this->hasOne(Secretary::class,'UserId','id');
    }
    public function medical_informations()
    {
        return $this->hasOne(MedicalInformation::class,'PatientId','id');
    }
    public function doctor_working_hours()
    {
        return $this->hasMany(DoctorWorkingHour::class,'DoctorId','id');
    }
    public function doctor_working_days(){
        return $this->belongsToMany(WorkingDay::class,'doctor_working_hours');
    }
    public function secretary_working_hours()
    {
        return $this->hasMany(SecretaryWorkingHour::class,'SecretaryId','id');
    }
    public function secretary_working_days(){
        return $this->belongsToMany(WorkingDay::class,'secretary_working_hours');
    }
//    public function doctor_appointments()
//    {
//        return $this->hasMany(Appointment::class,'DoctorId','id');
//    }
//    public function patient_appointments()
//    {
//        return $this->hasMany(Appointment::class,'PatientId','id');
//    }
    public function histories()
    {
        return $this->hasMany(History::class,'UserId','id');
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class,'ToUserId','id');
    }
}
