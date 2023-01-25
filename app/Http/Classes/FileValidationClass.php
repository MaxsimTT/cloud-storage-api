<?php

namespace App\Http\Classes;

class FileValidationClass
{

	public static array $files;

	public static function validation(array $files)
	{

		self::arr($files);

		// foreach ($files as $file) {
		// 	if ($file['error']) {
		// 		continue;
		// 	}

		// 	self::$files[] = $file;
		// }

		// return self::$files;
	}

	private static function arr(array $files)
	{
		$res_files = [];

		$files_count = count($files['name']);

		dd($files_count);
		return $files;
	}

}
