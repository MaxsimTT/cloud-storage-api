<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Classes\FileValidationClass;
use App\Http\Classes\DFileHelperClass;
use App\Models\FileFolder;
use App\Models\User;
use App\Models\File;
use App\Models\FileDescription;
use DB;

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

            $dir_root = self::getRootDirId($user);

            $path = storage_path("app\public\\{$dir_root}");
            $dir_path = $request->query('dir_id') ? $path . '\\' . $request->query('dir_id') : $path;
            $dir_id = substr(strrchr($dir_path, '\\'), 1);

            if (! FileFolder::find($dir_id)) {
                $dir_id = $dir_root;
                $dir_path = $path;
            }

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

            if (! self::createDirUploadFiles($dir_path)) {
                return redirect()->route('get_files');
            }

            foreach ($files as $key => $file) {

                $alias_name = DFileHelperClass::getRandomFileName($dir_path, $file['name']);

                $files[$key]['alias_name'] = $alias_name;
                $files[$key]['file_path'] = $dir_path . '\\' . $alias_name;
            }

            $result = self::uploadFile($files, $user, $dir_id);

        }
    }

    private static function createDirUploadFiles($dir_path): bool
    {
        if (!is_dir($dir_path)) {
            if (!mkdir($dir_path, 0777, true)) {
                return false;
            }
        }
        return true;
    }

    private static function findingRootFolder(User $user): int|bool
    {
        $folders_name = [];

        foreach ($user->folders as $folder) {
            if (isset($folder->forder_description->folder_name) && $folder->forder_description->folder_name == 'root') {
                return $folder->forder_description->folder_id;
            }
        }

        return false;
    }

    private static function getRootDirId(User $user): int
    {
        $dir_id = self::findingRootFolder($user);
        if ($dir_id == false) {
            $dir_id = $user->folders()->insertGetId(['user_id' => $user->id]);
            $result = DB::table('file_folder_descriptions')->insert(['folder_id' => $dir_id, 'folder_name' => 'root']);
            if (! $result) {
                return throw new \Exception("Error Processing Request", 1);
            }
        }

        return $dir_id;
    }

    private static function uploadFile(array $files_data, User $user, int $dir_id)
    {

        $data = [];
        foreach ($files_data as $file_data) {
            $data[] = new File([
                'user_id' => $user->id,
                'folder_id' => $dir_id,
                'file_path' => $file_data['file_path'],
                'file_size' => $file_data['size'],
            ]);
        }

        $result = $user->files()->saveMany($data);

        $data = [];
        foreach ($result as $res_file) {
            foreach ($files_data as $file_data) {
                if ($res_file['file_path'] == $file_data['file_path']) {
                    $data[] = [
                        'file_id' => $res_file->id,
                        'file_name' => $file_data['alias_name'],
                        'file_origin_name' => $file_data['name'],
                    ];
                }
            }
        }
        
        if (! DB::table('file_descriptions')->insert($data)) {
            return throw new \Exception("Error Processing Request", 1);
        }

        foreach ($files_data as $file_data) {
            dump($file_data);
            move_uploaded_file($file_data['tmp_name'], $file_data['file_path']);
        }
    }
}
