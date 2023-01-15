<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'folder_id',
        'file_path',
        'file_size',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function file_description() {
        return $this->hasOne('App\Models\FileDescription');
    }

    public function folder() {
        return $this->belongsTo('App\Models\FileFolder');
    }
}
