<?php

namespace App\Models;

use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorWorkingHour extends Model
{
    use HasFactory;
    protected $table='doctor_working_hours';
    protected $fillable = [
        'DoctorId',
        'WorkingDaysId',
        'From',
        'To',
        'Off',
        'IsDeleted',

    ];
    public $timestamps=true;
    public function user()
    {
        return $this->belongsTo(User::class,'DoctorId','id');
    }
    public function working_day()
    {
        return $this->belongsTo(WorkingDay::class,'WorkingDaysId','id');
    }
    public function getTimesPreiodAttribute($step){
        $times= CarbonInterval::minute($step)->toPeriod($this->From,$this->To)->toArray();
        return array_map(function ($time) {
            return $time;//->format('H:i');
        },$times);
    }
}
