<?php defined('BASEPATH') or exit('No direct script access allowed');

class LibpayException extends Exception
{
    public $tx_id = null;

}
