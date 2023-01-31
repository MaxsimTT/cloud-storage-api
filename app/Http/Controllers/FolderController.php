<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\FolderTrait;
use DB;
use Storage;

class FolderController extends Controller
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

    public function createFolder(Request $request)
    {

        if (! $request->filled('create-folde')) {
            return redirect()->route('get_files')->with(['message' => 'New folder didn\'t create']);
        }

        $dir_name = $request->input('create-folde');

        $user = $request->user();
        $root_dir = self::getRootDirId($user);

        $dir = $user->folders()->create();
        $result = DB::table('file_folder_descriptions')->insert(['folder_id' => $dir->id, 'folder_name' => $dir_name]);
        
        $res_create_dir = Storage::makeDirectory("user-files\\{$root_dir}\\{$dir->id}");

        if (! $res_create_dir) {
            return redirect()->route('get_files')->with(['message' => "New folder <{$dir_name}> didn\'t create"]);
        }

        return redirect()->route('get_files', ['dir_id' => $dir->id])->with(['message' => "Success create folder <{$dir_name}>"]);
    }
}
