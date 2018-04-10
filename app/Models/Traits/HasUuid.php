<?php

namespace App\Models\Traits;

use PDOException;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;

trait HasUuid
{
	protected static function bootHasUuid()
	{
		static::creating(function ($model) {
	        // Don't let people provide their own UUIDs, we will generate a proper one.
			$model->uuid = Uuid::uuid4()->toString();
		});

		static::saving(function ($model) {
	        // What's that, trying to change the UUID huh?  Nope, not gonna happen.
			$original = $model->getOriginal('uuid');

			if ($original !== $model->uuid) {
				$model->uuid = $original;
			}
		});
	}
}