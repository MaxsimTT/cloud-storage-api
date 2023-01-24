<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

    public function getFiles(Request $request)
    {
        // dump($request->user());
        return view('files');
    }

    public function addFiles(Request $request)
    {
        return $request->path();
    }
}
