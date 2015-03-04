<?php
class Charge_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->_table = 'charge';
    }

    /**
     * Retrieve charges, either by a list of IDs or by limit and offset.
     */
    public function charges()
    {
        $args = func_get_args();
        if (1 == count($args)) {
            return $this->charges_by_id($args[0]);
        }
        else {
            return $this->charges_by_limit($args[0], $args[1]);
        }
    }

    /**
     * Retrieve charges given a list of their IDs.
     *
     * @param array $ids
     */
    private function charges_by_id($ids = array())
    {

    }

    /**
     * Retrieve charges given a limit and offset. Retrieve all charges
     * if limit is not provided.
     *
     * @param int $limit
     * @param int $offset
     */
    private function charges_by_limit($limit, $offset = 0)
    {
        $this->load->model('charge_field_model');

        if ($limit) {
            $this->limit($limit, $offset);
        }

        $ids = array_map(create_function('$i', 'return $i->id;'), $this->get_all());

        return $this->pivot($ids);
    }

    /**
     * Retrieve a single charge given its ID.
     * @param int $id
     * @return mixed
     */
    public function charge($id)
    {
        $this->load->model('charge_field_model');
        return array_shift($this->pivot(array($id)));
    }




    /**
     * Pivot the charge_field table to return objects with the following fields:
     * patron_name, umid, hshsl_category, hshshl_category_ohter, hshsl_amount_dollar,
     * hshsl_amount_cents, hshsl_cleared, stripe_id, stripe_created, stripe_status.
     *
     * @param array $ids
     */
    private function pivot($ids = array())
    {
        $fields = array(
            'patron_name',
            'umid',
            'hshsl_category',
            'hshsl_category_other',
            'hshsl_amount_dollar',
            'hshsl_amount_cents',
            'hshsl_cleared',
            'stripe_id',
            'stripe_created',
            'stripe_status'
            );

        $pivot = array();
        foreach ($fields as $field) {
            $pivot[] = "max(if (charge_field.charge_field = '{$field}', charge_field.charge_value, NULL)) as {$field}";
        }
        $pivot_fields = implode(', ', $pivot);

        $this->db->select("charge.id, {$pivot_fields}", FALSE);
        $this->db->join('charge_field', 'charge_field.charge_id = charge.id');
        if (count($ids)) {
            $this->db->where_in('charge.id', $ids);
        }
        $this->db->group_by('charge.id');
        $this->order_by('id', 'desc');

        return $this->db->get('charge')->result();
    }

}