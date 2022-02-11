<?php

namespace FilippoToso\DialogflowBackup\Exceptions;

use Exception;
use Throwable;

class BackupException extends Exception
{
    protected $status;

    public function __construct($status, $message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }
}
