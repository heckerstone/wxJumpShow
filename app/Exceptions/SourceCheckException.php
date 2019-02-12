<?php
/**
 * Created by PhpStorm.
 * User: ALG
 * Date: 2019/2/3 0003
 * Time: 10:31
 */

namespace App\Exceptions;

use Exception;

class SourceCheckException extends Exception
{
//
    public function __construct($message = "") {
        parent::__construct($message,403);
    }
}