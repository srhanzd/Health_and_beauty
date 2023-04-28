<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dependency extends Model
{
    use HasFactory;
    protected $table='dependencies';
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
    public function dependency_rows()
    {
        return $this->hasMany(DependencyRow::class,'DependencyId','id');
    }
}
