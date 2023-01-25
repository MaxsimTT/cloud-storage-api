<?php

namespace App\Http\Classes;

class FileValidationClass
{

	public static array $files;

	public static function validation(array $files)
	{

		$res = [];

		foreach (self::arr($files) as $file) {

			if ($file['error']) {
				continue;
			}

			if (strtolower(substr(strrchr($file['name'], '.'), 1)) === 'php') {
				continue;
			}

			$res[] = $file;
		}

		dump($res);
		// return self::$files;
	}

	private static function arr(array $files): array
	{
		$res_files = [];

		$files_count = count($files['name']);
		$file_attrs = array_keys($files);

		for ($i = 0; $i < $files_count; $i++) {
			foreach ($file_attrs as $file_attr) {
				$res_files[$i][$file_attr] = $files[$file_attr][$i];
			}
		}

		return $res_files;
	}

}
