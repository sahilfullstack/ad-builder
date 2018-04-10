<?php

namespace App\Models\Traits;

use PDOException;
use Illuminate\Database\Eloquent\Model;

trait ContainsSoftDeletableUniques
{
	protected static function bootContainsSoftDeletableUniques()
	{
		// We want to make sure that the model was actually soft deleted
		// by Laravel, therefore, we are making our changed after it has
		// done its work.
		static::deleted(function(Model $model)
		{
		    $model->withTrashed()
		        ->where('id', $model->id)
		        ->update([
		            static::SOFT_DELETION_TOKEN => (int) round(microtime(true) * 1000)
		        ]);
		    return true;
		});

		// We don't want two models that violate unique integrity contraints to
		// be able to get restored, therefore, we will make our attempt before
		// Laravel marks them restored.
		static::restoring(function(Model $model)
		{
		    try
		    {
		        $model->withTrashed()
			        ->where('id', $model->id)
			        ->update([
			            static::SOFT_DELETION_TOKEN => 0
			        ]);

		        return true;
		    }
		    catch(PDOException $e)
		    {
		        return false;
		    }
		});

		// When restored, we'll update the required attribute on the model too.
		static::restored(function(Model $model)
		{
		    $model->{static::SOFT_DELETION_TOKEN} = 0;

		    return true;
		});
	}
}