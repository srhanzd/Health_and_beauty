<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;
    protected $table='rules';
    protected $fillable = [
        'StaticAttributeID',
        'DynamicAttributeId',
        'NewDynamicAttributeId',
        'OperationId',
        'ClinicId',
        'OperationValueString',
        'OperationValueDouble',
        'OperationValueDateTime',
        'OperationValueBoolean',
        'IsDeleted',
    ];
    public $timestamps=true;
    public function static_attribute()
    {
        return $this->belongsTo(StaticAttribute::class,'StaticAttributeID','id');
    }
    public function dynamic_attribute()
    {
        return $this->belongsTo(DynamicAttribute::class,'DynamicAttributeId','id');
    }
    public function new_dynamic_attribute()
    {
        return $this->belongsTo(DynamicAttribute::class,'NewDynamicAttributeId','id');
    }
    public function operation()
    {
        return $this->belongsTo(Operation::class,'OperationId','id');
    }
    public function clinic()
    {
        return $this->belongsTo(Clinic::class,'ClinicId','id');
    }
    public function row_rules()
    {
        return $this->hasMany(RowRule::class,'RuleId','id');
    }
}
