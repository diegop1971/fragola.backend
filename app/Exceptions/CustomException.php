<?php
 
namespace App\Exceptions;
 
use Exception;
 
class CustomException extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
    }
 
    public function render()
    {
        return response()->view('errors.custom', array('exception' => $this)
        );
    }
}