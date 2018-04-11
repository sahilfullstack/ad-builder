<?php 

namespace App\Exceptions;

class UnauthorisedException extends Exception {
    
    const CODE = 401;

    /**
     * Create a new authentication exception.
     *
     * @param string  $message
     */
    public function __construct(String $message = 'Unauthorised.')
    {    	
        parent::__construct($message, self::CODE);
    }
}
