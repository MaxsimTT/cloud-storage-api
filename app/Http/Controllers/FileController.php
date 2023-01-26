<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Classes\FileValidationClass;
use App\Http\Classes\DFileHelperClass;

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

            $user = $request->user();

            $path = storage_path("app\public\\{$user->id}\\");
            $dir_path = $request->query('dir') ? $path . $request->query('dir') . '\\' : $path;

            $validation_params = [
                'max_size' => 10485760,
                'except_extensions' => [
                    'php',
                ],
                'except_type' => [],
            ];

            $files_post = $_FILES;

            foreach ($files_post as $files) {
                $files = FileValidationClass::validation($files, $validation_params);
            }

            if (! $files) {
                return redirect()->route('get_files');
            }

            dump($dir_path);

            foreach ($files as $key => $file) {
                $files[$key]['alias_name'] = DFileHelperClass::getRandomFileName($dir_path, $file['name']);
            }

            if (! self::createDirUploadImg($dir_path)) {
                return redirect()->route('get_files');
            }

            foreach ($files as $file) {

            }

            dump($files);
        }
    }

    private static function createDirUploadImg($dir_path): bool
    {
        if (!is_dir($dir_path)) {
            if (!mkdir($dir_path, 0777, true)) {
                return false;
            }
        }
        return true;
    }
}
