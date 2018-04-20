<?php 

namespace App\Exceptions;

use Exception as PHPException;

class CustomInvalidInputException extends PHPException {
   	
   	const CODE = 400;
    protected $key;

    /**
     * Create a new authentication exception.
     *
     * @param string  $message
     */
    public function __construct(String $key, String $message = 'Invalid input.')
    {
        parent::__construct($message, self::CODE);

        $this->key = $key;
    }

    public function getJsonResponse()
    {
        return response()->json(
                [
                    'errors' => [
                        $this->key => [
                            $this->getMessage()
                        ]
                    ], 
                    'code' => $this->getCode()
                ], 
            $this->getCode()
        );
    }
}
