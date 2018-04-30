<?php

namespace App\Http\Middleware;  
  
use Closure;  
use Illuminate\Contracts\Auth\Guard;  
use Response;  
  
class ValidApiHeaders  
{  
    /** 
     * The Guard implementation. 
     * 
     * @var Guard 
     */  
  
    /** 
     * Handle an incoming request. 
     * 
     * @param  \Illuminate\Http\Request  $request 
     * @param  \Closure  $next 
     * @return mixed 
     */  
    public function handle($request, Closure $next)  
    {  
        $responseFormat = null;

        if( ! isset($_SERVER['CONTENT_TYPE']))
        {  
            return Response::json(array('error' => 'Please set content type'));  
        } 

        if( ! in_array($_SERVER['CONTENT_TYPE'], ['application/vnd.mesa.v1+xml', 'application/vnd.mesa.v1+json'])) 
        {  
            return Response::json(array('error'=>'Content type must be valid.'));  
        }

        if($_SERVER['CONTENT_TYPE'] == 'application/vnd.mesa.v1+xml')
        {
            $responseFormat = 'xml';
        }

        if($_SERVER['CONTENT_TYPE'] == 'application/vnd.mesa.v1+json')
        {
            $responseFormat = 'json';
        }
        
        $request->attributes->add(['responseFormat' => $responseFormat]);
        
        return $next($request);  
    }  
}