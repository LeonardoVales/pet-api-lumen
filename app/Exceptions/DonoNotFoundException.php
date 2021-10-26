<?php

namespace App\Exceptions;

use Fig\Http\Message\StatusCodeInterface;

class DonoNotFoundException extends \DomainException
{
    public function __construct()
    {        
        parent::__construct(
            'O dono não foi encontrado', 
            StatusCodeInterface::STATUS_NOT_FOUND
        );
    }
}