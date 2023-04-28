<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RowRule extends Model
{
    use HasFactory;
    protected $table='row_rules';
    protected $fillable = [
        'RowId',
        'RuleId',
        'IsDeleted',

    ];
    public $timestamps=true;
    public function row()
    {
        return $this->belongsTo(Row::class,'RowId','id');
    }
    public function rule()
    {
        return $this->belongsTo(Rule::class,'RuleId','id');
    }
}
