<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secretary extends Model
{
    use HasFactory;
    protected $table='secretaries';
    protected $fillable = [
        'UserId',
        'ClinicId',
        'IsDeleted',
    ];
    public $timestamps=true;
    public function user()
    {
        return $this->belongsTo(User::class,'UserId','id');
    }
    public function clinic()
    {
        return $this->belongsTo(Clinic::class,'ClinicId','id');
    }
}
