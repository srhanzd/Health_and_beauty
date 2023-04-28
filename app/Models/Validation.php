<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validation extends Model
{
    use HasFactory;
    protected $table='validations';
    protected $fillable = [
        'DynamicAttributeId',
        'OperationId',
        'ValueString',
        'ValueDouble',
        'ValueDateTime',
        'ValueBoolean',
        'IsDeleted',

    ];
    public $timestamps=true;
    public function dynamic_attribute()
    {
        return $this->belongsTo(DynamicAttribute::class,'DynamicAttributeId','id');
    }
    public function operation()
    {
        return $this->belongsTo(Operation::class,'OperationId','id');
    }
}
