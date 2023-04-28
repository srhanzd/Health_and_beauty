<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DependencyRow extends Model
{
    use HasFactory;
    protected $table='dependency_rows';
    protected $fillable = [
        'DependencyId',
        'RowId',
        'IsDeleted',

    ];
    public $timestamps=true;
    public function dependency()
    {
        return $this->belongsTo(Dependency::class,'DependencyId','id');
    }
    public function row()
    {
        return $this->belongsTo(Row::class,'RowId','id');
    }
}
