<?php 

namespace App\Exceptions;

class InternalException extends Exception {

	const CODE = 500;

    /**
     * Create a new authentication exception.
     *
     * @param string  $message
     */
    public function __construct(String $message = 'Something went wrong.')
    {
        parent::__construct($message, self::CODE);
    }
}
