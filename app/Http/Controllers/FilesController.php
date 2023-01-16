<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function show(Request $request)
    {
        $path = $request->path();
        return $path;
    }
}
