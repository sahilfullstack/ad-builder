<?php

namespace App\Models\Traits;

use App\Models\Unit;

trait HasVersionedImages
{
	public function imageVersion($attribute, $version)
	{
	    $default = config('image.defaults.version');

	    return str_replace_last("/$default", "/$version", $this->$attribute);
	}
}