<?php
namespace Jota\SdnList\Exceptions;
use Exception;

class ConnectionException extends Exception {

    public $response;

    public function __construct($message, $response)
    {
        $this->response = $response;
        parent::__construct($message);
    }
}
