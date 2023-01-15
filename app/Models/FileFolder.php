<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileFolder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    public function files() {
        return $this->hasMany('App\Models\File');
    }

    public function forder_description()
    {
        return $this->hasOne('App\Models\FileFolderDescription');
    }



}
