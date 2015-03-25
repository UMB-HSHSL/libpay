<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'libraries/Stripe.php';

class Admin extends Authenticated_Controller
{
    public function __construct()
    {
        parent::__construct();
        Stripe::setApiKey(config_item('stripe_secret_key'));
        $this->load->helper('stripe');
        $this->load->helper('url');
        $this->load->helper('security');

        $this->load->library('libpay');
    }


    /**
     * Show summary of all transactions.
     *
     * @param number $limit number of transactions to show
     * @param number $offset offset in transaction list
     */
    public function index($limit = 0, $offset = 0)
    {
        $this->load->library('form_validation');

        $this->load->model('charge_model');
        $this->load->model('charge_field_model');

        $data['charges'] = $this->charge_model->charges($limit, $offset);

        $this->template->title = 'Online Payments Received';
        $this->template->content->view('admin/index', $data);

        $this->template->javascript->add('//cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js');
        $this->template->foot = '<script>$("#tx_table").dataTable({"order" : [[3, "desc"], [0, "asc"]]});</script>';
        $this->template->publish();
    }



    /**
     * Show transaction details.
     * @param int $id HSHSL transaction details
     */
    public function details($id)
    {
        $this->load->model('charge_model');
        $this->load->model('charge_field_model');

        $data['charge'] = $this->charge_model->charge($id);
        $data['receipt'] = Stripe_Charge::retrieve($data['charge']->stripe_id);

        $this->template->title = 'Lib Pay Charge Details';
        $this->template->content->view('admin/detail', $data);
        $this->template->publish();
    }



    /**
     * Show a duplicate receipt
     * @param int $id HSHSL transaction ID
     */
    public function receipt($id)
    {
        $this->load->model('charge_model');
        $this->load->model('charge_field_model');

        $data['success'] = true;
        $data['account'] = Stripe_Account::retrieve();
        $data['details'] = $this->charge_model->charge($id);
        $data['receipt'] = Stripe_Charge::retrieve($data['details']->stripe_id);

        $this->template->title = 'Lib Pay Duplicate Receipt';
        $this->template->content->view('welcome/receipt', $data);
        $this->template->publish();
    }


    /**
     * Mark transcations as cleared in Aleph. Record the date and the user who cleared them.
     */
    public function clear()
    {
        $ids = $this->input->post('id');
        if (! $ids) {
            $ids = array();
        }

        $this->load->model('charge_model');
        $this->load->model('charge_field_model');

        $count = 0;
        foreach ($ids as $id) {
            $charge = $this->charge_model->get($id);
            if (! isset($charge->hshsl_cleared)) {
                $count++;
                $this->charge_field_model->insert($id, 'hshsl_cleared', 1);
                $this->charge_field_model->insert($id, 'hshsl_cleared_by', $this->authenticator->username());
                $this->charge_field_model->insert($id, 'hshsl_cleared_date', time());
            }
        }

        flash_message('info', "Cleared {$count} transactions.");
        redirect('admin');
    }


}
