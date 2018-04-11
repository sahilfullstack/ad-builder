<?php 

namespace App\Services\FileUploader\Exceptions;

use Exception;

class InvalidInputException extends Exception {

	const CODE = 400;

    /**
     * Create a new authentication exception.
     *
     * @param string  $message
     */
    public function __construct(String $message = 'Invalid input.')
    {
        parent::__construct($message, self::CODE);
    }
}
