<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileDescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_id',
        'file_name',
        'file_origin_name',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
