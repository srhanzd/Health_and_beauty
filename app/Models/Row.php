<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Row extends Model
{
    use HasFactory;
    protected $table='rows';
    protected $fillable = [
        'IsDeleted',
    ];
    public $timestamps=true;
    public function dependency_rows()
    {
        return $this->hasMany(DependencyRow::class,'RowId','id');
    }
    public function row_rules()
    {
        return $this->hasMany(RowRule::class,'RowId','id');
    }
}
