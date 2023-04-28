<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataType extends Model
{
    use HasFactory;
    protected $table='Data_Types';
    protected $fillable = [
        'Name',
        'IsDeleted',

    ];
    public $timestamps=true;
    public function static_attributes()
    {
        return $this->hasMany(StaticAttribute::class,'DataTypeId','id');
    }
    public function dynamic_attributes()
    {
        return $this->hasMany(DynamicAttribute::class,'DataTypeId','id');
    }
}
