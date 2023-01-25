<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Classes\FileValidationClass;

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
        if ($request->isMethod('post')) {

            $files_post = $_FILES;

            foreach ($files_post as $files) {
                $files = FileValidationClass::validation($files);
            }
            // dump($files, array_keys($files['files']));

            

            // dump($files);

            // dump($_FILES['file'], storage_path('\app\public\\'));

            // $file = storage_path('\app\public\\') . 'qwewq';

            // return move_uploaded_file($_FILES['file']['tmp_name'], $file);

            // return $request->path();
        }
    }
}
