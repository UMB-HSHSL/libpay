<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'libraries/Stripe.php';

class Welcome extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        Stripe::setApiKey(config_item('stripe_secret_key'));
        $this->load->helper('stripe');
        $this->load->library('libpay');
    }

    public function index()
    {
        $this->output->set_header('Cache-Control: max-age=0, no-store, no-cache, must-revalidate, proxy-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Expires: Tue, 03 Jul 2001 06:00:00 GMT');
        $this->output->set_header('Last-Modified: ' . gmdate(DateTime::RFC2822) . ' GMT');

        $this->load->library('form_validation');
        if ($this->is_post()) {
            $this->index_handle_post();
        } else {
        	$this->index_handle_get();
        }
    }

    /**
     * Show the payment form
     */
    private function index_handle_get()
    {
        $account = Stripe_Account::retrieve();
        $this->template->title = 'Secure Payment Form';
        $this->template->business_name = $account->business_name;
        $this->template->stripe_public_key = config_item('stripe_public_key');

        $this->template->content->view('welcome/index');
        $this->template->foot->view('welcome/index_script');
        $this->template->javascript->add('assets/js/bootstrapValidatorLibpay.js');
        $this->template->javascript->add('assets/js/libpay-validation.js');
        $this->template->javascript->add('assets/js/libpay.js');
        $this->template->publish();
    }

    /**
     * Handle a payment submission.
     * On validation error redisplay the form;
     * otherwise show the receipt. Stripe errors will be displayed on the
     * receipt page as well.
     *
     * Note that caught exceptions are converted to LibpayError objects so they can
     * be efficiently serialized. We don't need the whole exception stacktrace at
     * this point; that should already have been logged elsewhere. All we need is
     * to store the message and transaction_id to show the user on the receipt.
     */
    private function index_handle_post()
    {
        $rules = array(
            array(
                'field' => 'hshsl_amount_dollar',
                'label' => '',
                'rules' => 'required'
            ),
            array(
                'field' => 'hshsl_amount_cents',
                'label' => '',
                'rules' => 'required'
            ),
            array(
                'field' => 'hshsl_category',
                'label' => '',
                'rules' => 'required'
            ),
            array(
                'field' => 'patron_name',
                'label' => '',
                'rules' => 'required'
            ),
            array(
                'field' => 'street',
                'label' => '',
                'rules' => 'required'
            ),
            array(
                'field' => 'city',
                'label' => '',
                'rules' => 'required'
            ),
            array(
                'field' => 'zip',
                'label' => '',
                'rules' => 'required'
            ),
            array(
                'field' => 'stripeToken',
                'label' => '',
                'rules' => 'required'
            ),
        );

        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run()) {

        	try {
                $this->session->set_flashdata('hshsl_details', (object) $_POST);
                $this->session->set_flashdata('stripe_success', false);

        	    $res = $this->libpay->pay(
        	        ($this->input->post('hshsl_amount_dollar') * 100) + $this->input->post('hshsl_amount_cents'),
        	        $this->input->post('stripeToken'),
        	        $this->input->post('hshsl_category'),
        	        $this->input->post('email')
        	    );

        	    $this->libpay->log_transaction_supplement($res, (object) $_POST);
        	    $this->session->set_flashdata('stripe_success', true);

        	    // store the receipt ID only so we don't run over 4k in our cookie.
        	    // we can retrieve the data in receipt handler.
        	    $this->session->set_flashdata('stripe_id', $res->id);
        	}

            catch (LibpayException $e) {
                $this->session->set_flashdata('stripe_exception', new LibpayError($e));
                $this->ci->session->set_flashdata('stripe_exception', $e);
            }
            catch (Exception $e) {
                $this->libpay->log_exception($e->getMessage(), $e);
                $le = new LibpayException('There was an error and your transaction could not be processed');
                $this->ci->session->set_flashdata('stripe_exception', new LibpayError($le));
            }

            redirect('welcome/receipt');
        } else {
            $this->index_handle_get();
        }
    }




    /**
     * Show the receipt
     */
    public function receipt()
    {
        $this->load->helper('stripe');

        $data = array(
            'success' => $this->session->flashdata('stripe_success'),
            'error'   => $this->session->flashdata('stripe_exception'),
            'account' => Stripe_Account::retrieve(),
            'details' => $this->session->flashdata('hshsl_details'),
            'receipt_id' => $this->session->flashdata('stripe_id'),
            'receipt'    => null,
        );

        if ($data['success'] && $data['receipt_id']) {
            $data['receipt'] = Stripe_Charge::retrieve($data['receipt_id']);
        }
        // we weren't successful, but we don't have an error. prolly some
        // hacker trying to glean data from the receipt page directly.
        // sorry; nothing to see here. move along.
        elseif (! $data['error']) {
            $le = new LibpayException("Your transaction could not be completed.");
            $data['error'] = new LibpayError($le);
        }

        $this->template->title = 'Secure Payment Receipt';
        $this->template->content->view('welcome/receipt', $data);
        $this->template->publish();
    }

}
