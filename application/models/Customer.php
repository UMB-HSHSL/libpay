<?php

class Customer
{
    // whitelisted fields to accept from a $_POST request, presumably
    private $fields = array(
        'hshsl_category',
        'hshsl_category_other',
        'invoice_no',
        'hshsl_amount_dollar',
        'hshsl_amount_cents',
        'patron_name',
        'umid',
        'phone',
        'email',
        'instruction',
        'street',
        'city',
        'state',
        'zip'
    );

    private $values = null;

    public function __construct(array $hash)
    {
        $this->values = (object) array();
        foreach ($hash as $k => $v) {
            $this->{$k} = $v;
        }
    }

    public function __set($k, $v)
    {
        if (in_array($k, $this->fields)) {
            $this->values->{$k} = $v;
        }
    }

    public function __get($k)
    {
        if (in_array($k, $this->fields)) {
            return $this->values->{$k};
        }
    }

    public function fields()
    {
        return $this->fields;
    }

    public function values()
    {
        return $this->values;
    }


}