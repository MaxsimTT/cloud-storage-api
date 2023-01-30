<?php

namespace App\Http\Classes;

use Storage;

class FileValidationClass
{

	public static array $files;

	public static function validation(array $files, array $validation_params): array
	{

		$res = [];

		foreach ($files as $file) {

			if (! $file->isValid()) {
				continue;
			}

			if (in_array($file->getClientOriginalExtension(), $validation_params['except_extensions'])) {
				continue;
			}

			if ($file->getSize() > $validation_params['max_size'] || $file->getSize() > $file->getMaxFilesize()) {
				continue;
			}

			$res[] = $file;
		}

		return $res;
	}
}
