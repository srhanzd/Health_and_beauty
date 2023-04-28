<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;
    protected $table='operations';
    protected $fillable = [
        'Name',
        'IsDeleted',

    ];
    public $timestamps=true;
    public function dependencies()
    {
        return $this->hasMany(Dependency::class,'OperationId','id');
    }
    public function validations()
    {
        return $this->hasMany(Validation::class,'OperationId','id');
    }
    public function rules()
    {
        return $this->hasMany(Rule::class,'OperationId','id');
    }

}

