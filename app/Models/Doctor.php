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
    public  function scopeFilter($query,array $filters)
    {
        $query->when($filters['search_query'] ?? false, function ($query, $search) {
            $query->where('Degree', 'like', '%' . $search . "%")
                ->orWhere('Specialization','like','%'.$search."%");

        });
    }



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
    public function image()//s
    {
        return $this->hasOne(Image::class,'DoctorId','id');//has many
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class,'DoctorId','id');
    }
//    public function admins(){
//        return $this->hasMany(Admins::class,'DoctorId','id');->has one not many
//    }

}
