<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecretaryWorkingHour extends Model
{
    use HasFactory;
    protected $table='secretary_working_hours';
    protected $fillable = [
        'SecretaryId',
        'WorkingDaysId',
        'From',
        'To',
        'Off',
        'IsDeleted',

    ];
    public $timestamps=true;
    public function user()
    {
        return $this->belongsTo(User::class,'SecretaryId','id');
    }
    public function working_days()
    {
        return $this->belongsTo(WorkingDay::class,'WorkingDaysId','id');
    }
}
