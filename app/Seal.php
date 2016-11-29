<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seal extends Model
{
    protected $fillable = [
        'name', 'drawing_number', 'bom_number', 'end_user', 'seal_type', 'size', 'material_number', 'code', 'model', 'serial_number','tag', 'price'
    ];
}
