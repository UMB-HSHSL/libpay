<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'libraries/Stripe.php';

class Admin extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        Stripe::setApiKey(config_item('stripe_secret_key'));
        $this->load->helper('stripe');
        $this->load->library('libpay');
    }

    public function index($limit = 0, $offset = 0)
    {
        $this->load->library('form_validation');

        $this->load->model('charge_model');
        $this->load->model('charge_field_model');

        $data['charges'] = $this->charge_model->charges($limit, $offset);

        $this->template->title = 'Lib Pay Charges';
        $this->template->content->view('admin/index', $data);

        $this->template->javascript->add('//cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js');
        $this->template->foot = '<script>$("#tx_table").dataTable();</script>';
        $this->template->publish();
    }


    public function details($id)
    {
        $this->load->model('charge_model');
        $this->load->model('charge_field_model');

        $data['charge'] = $this->charge_model->charge(id);

        $this->template->title = 'Lib Pay Charge Details';
        $this->template->content->view('admin/detail', $data);
        $this->template->publish();
    }

    public function clear()
    {
        $ids = $this->input->post('id');
        if (! $ids) {
            $ids = array();
        }

        $this->load->model('charge_model');
        $this->load->model('charge_field_model');

        foreach ($ids as $id) {
            $charge = $this->charge_model->get($id);
            if (! isset($charge->hshsl_cleared)) {
                $this->charge_field_model->insert($id, 'hshsl_cleared', 1);
                $this->charge_field_model->insert($id, 'hshsl_cleared_by', '');
                $this->charge_field_model->insert($id, 'hshsl_cleared_date', time());
            }
        }

        redirect('admin');
    }


}
