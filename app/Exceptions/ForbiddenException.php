<?php 

namespace App\Exceptions;

class ForbiddenException extends Exception {

	const CODE = 403;

    /**
     * Create a new authentication exception.
     *
     * @param string  $message
     */
    public function __construct(String $message = 'Forbidden.')
    {
        parent::__construct($message, self::CODE);
    }
}
