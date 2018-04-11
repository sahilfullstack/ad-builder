<?php 

namespace App\Exceptions;

use Exception as PHPException;

class Exception extends PHPException {

    /**
     * Create a new authentication exception.
     *
     * @param string  $message
     */
    public function __construct(String $message, Int $code)
    {
        parent::__construct($message, $code);
    }

    public function getJsonResponse()
    {
        return response()->json(
        		[
        			'errors' => [
        				'_general' => [
        					$this->getMessage()
        				]
        			], 
        			'code' => $this->getCode()
        		], 
        	$this->getCode()
        );
    }
}
