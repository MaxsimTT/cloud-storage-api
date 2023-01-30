<?php

namespace App\Http\Traits;

use App\Models\User;
use DB;

trait FolderTrait
{

    private static function findingRootFolder(User $user): int|bool
    {

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

}