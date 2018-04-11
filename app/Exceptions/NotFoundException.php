<?php 

namespace App\Exceptions;

class NotFoundException extends Exception {

	const CODE = 404;

    /**
     * Create a new authentication exception.
     *
     * @param string  $message
     */
    public function __construct(String $message = 'Not found.')
    {
        parent::__construct($message, self::CODE);
    }
}
