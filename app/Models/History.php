<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $table='histories';
    protected $fillable = [
        'UserId',
        'ApiUrl',
        'IP',
//        'Date',
        'IsDeleted',

    ];
    public $timestamps=true;
    public function user()
    {
        return $this->belongsTo(User::class,'UserId','id');
    }
}
