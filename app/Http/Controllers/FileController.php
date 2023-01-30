<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Classes\FileValidationClass;
use App\Http\Classes\DFileHelperClass;
use App\Models\FileFolder;
use App\Models\User;
use App\Models\File;
use App\Models\FileDescription;
use App\Http\Traits\FolderTrait;
use DB;

class FileController extends Controller
{

    use FolderTrait;

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

    public function getFiles(Request $request, $dir_id = '')
    {
        
        $user = $request->user();
        $dir_id = (int) $dir_id ? (int) $dir_id : self::getRootDirId($user);

        $files = $user->files()->where('folder_id', $dir_id)->get();

        return view('files', ['files' => $files]);
    }

    public function addFiles(Request $request)
    {
        if ($request->isMethod('post')) {

            $files = $request->file();

            if (! $files) {
                return redirect()->route('get_files')->with(['message' => 'Empty array with files']);
            }

            $validation_params = [
                'max_size' => 10485760,
                'except_extensions' => [
                    'php',
                ],
                'except_type' => [],
            ];

            $count_upload_files = 0;

            foreach ($files as $files_data) {
                $count_upload_files += count($files_data);
                $files = FileValidationClass::validation($files_data, $validation_params);
            }

            $user = $request->user();

            $dir_root = self::getRootDirId($user);
            $dir_id = $request->query('dir_id') ? $request->query('dir_id') : $dir_root;

            if (! FileFolder::find($dir_id)) {
                $dir_id = $dir_root;
            }

            $result = self::uploadFile($files, $user, $dir_id);
            $success_upload_files = count($result);
            $feils_upload_files = $count_upload_files - $success_upload_files;

            return redirect()->route('get_files')->with(['message' => "Success upload files {$success_upload_files} \ feils {$feils_upload_files}"]);
        }
    }

    private static function uploadFile(array $files_data, User $user, int $dir_id): array
    {
        $result = [];
        $data_files = [];
        $data_files_desc = [];

        foreach ($files_data as $file) {
            $path = $file->store("user-files/{$dir_id}");
            if ($path) {

                $data_files[] = new File([
                    'user_id' => $user->id,
                    'folder_id' => $dir_id,
                    'file_path' => $path,
                    'file_size' => $file->getSize(),
                ]);

                $data_files_desc[] = [
                    'file_name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                ];
            }
        }

        $result = $user->files()->saveMany($data_files);

        if ($user->files()->saveMany($data_files)) {
            $result = $user->files()->saveMany($data_files);

            foreach ($result as $res_file) {
                foreach ($data_files_desc as $key => $file_data) {
                    if ($res_file['file_path'] == $file_data['file_path']) {
                        $data_files_desc[$key]['file_id'] = $res_file->id;
                    }
                }
            }

            foreach ($data_files_desc as $key => $file_data) {
                unset($data_files_desc[$key]['file_path']);
            }

            if (! DB::table('file_descriptions')->insert($data_files_desc)) {
                return throw new \Exception("Error Processing Request", 1);
            }
        }

        return $result;
    }
}
