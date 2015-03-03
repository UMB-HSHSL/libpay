<?php
class Charge_field_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->_table = 'charge_field';
    }

    public function insert($id, $field, $value)
    {
        parent::insert(array(
            'charge_id' => $id,
            'charge_field' => $field,
            'charge_value' => $value
        ));

    }


}