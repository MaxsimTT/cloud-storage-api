<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileFolderDescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'folder_id',
        'folder_name',
    ];

    public function file_folder() {
        $this->belongsTo('App\Models\FileFolder');
    }

}
