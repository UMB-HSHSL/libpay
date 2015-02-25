<?php defined('BASEPATH') or exit('No direct script access allowed');

// serializable LibpayException without a stacktrace so we don't
// blast through our cookie's meager 4k of storage
class LibpayError
{
    public $message;
    public $tx_id;

    public function __construct(LibpayException $le)
    {
        $this->message = $le->getMessage();
        $this->tx_id = $le->tx_id;
    }
}
