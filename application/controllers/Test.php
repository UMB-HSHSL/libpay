<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'libraries/Stripe.php';

class Test extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        Stripe::setApiKey(config_item('stripe_secret_key'));
        $this->load->helper('stripe');

        $this->load->library('libpay');

        $this->set_post();
    }

    private function set_post()
    {
        $hshsl_details = array
        (
            'hshsl_category' => 'Library Fines',
            'hshsl_category_other' => '',
            'invoice_no' =>'',
            'hshsl_amount_dollar' => '12',
            'hshsl_amount_cents' => '34',
            'patron_name' => 'Testy McTesterson',
            'umid' => 'tmct',
            'phone' => '1231231234',
            'email' => 'test@example.com',
            'instruction' => '',
            'street' => '601 West Lombard St',
            'city' => 'Baltimore',
            'state' => 'MD',
            'zip' => '21201',
            'cardholdername' => 'Test McTesterson',
            'select2' => '2016',
        );

        $this->session->set_flashdata('hshsl_details', (object)$hshsl_details);
    }

    // token for a regular transaction
    private function token()
    {
        return Stripe_Token::create(array(
            "card" => array(
                "number" => "4242424242424242",
                "exp_month" => 2,
                "exp_year" => 2016,
                "cvc" => "314"
            )
        ));
    }

    // token for a declined transaction
    private function token_decline()
    {
        return Stripe_Token::create(array(
            "card" => array(
                "number" => "4000000000000002",
                "exp_month" => 2,
                "exp_year" => 2016,
                "cvc" => "314"
            )
        ));
    }

    // token for a bad card
    private function token_card_error()
    {
        try {
            return Stripe_Token::create(array(
                "card" => array(
                    "number" => "not-a-credit-card-number",
                    "exp_month" => 2,
                    "exp_year" => 2016,
                    "cvc" => "314"
                )
            ));

        }
        // card error (decline)
        catch (Stripe_CardError $e) {
            $body = $e->getJsonBody();
            $error = (object) $body['error'];

            $le = new LibpayException($error->message);
            $le->tx_id = $error->charge;

            throw $le;
        }

    }

    // trigger a Stripe invalid_request_error with a bad tx token
    public function invalid_request_error()
    {
        $token = $this->token();
        $token->id = 'bad-token';

        try {
            $this->libpay->pay(
                314,
                'bad-token',
                'bad token test',
                'test@example.com'
                );
        }
        catch (LibpayException $e) {
            $this->session->set_flashdata('stripe_exception', new LibpayError($e));
        }
        redirect('welcome/receipt');
    }

    // trigger a Stripe authentication_error with bad key credentials
    public function authentication_error()
    {
        $token = $this->token();
        Stripe::setApiKey('bad-api-key');

        try {
            $this->libpay->pay(
                314,
                $token->id,
                'bad api key test',
                'test@example.com'
            );
        }
        catch (LibpayException $e) {
            $this->session->set_flashdata('stripe_exception', new LibpayError($e));
        }
        redirect('welcome/receipt');

    }

    public function api_connection_error()
    {

    }

    // trigger a Stripe card_error with a decline-token
    public function card_error()
    {

        try {
            $token = $this->token_card_error();

            // error: should not execute
            print "UNREACHABLE CODE";
            exit;

        }
        catch (LibpayException $e) {
            $this->session->set_flashdata('stripe_exception', new LibpayError($e));
        }

        redirect('welcome/receipt');

    }


    // trigger a Stripe card_error with a decline-token
    public function decline()
    {
        $token = $this->token_decline();

        try {
            $res = $this->libpay->pay(
                314,
                $token->id,
                'card decline test',
                'test@example.com'
            );

            // error: should not execute
            print "UNREACHABLE CODE";
            exit;

        }
        catch (LibpayException $e) {
            $this->session->set_flashdata('stripe_exception', new LibpayError($e));
        }

        redirect('welcome/receipt');

    }



    // decline, cvc, expired, error
    public function test()
    {
        $this->output->set_header('Cache-Control: max-age=0, no-store, no-cache, must-revalidate, proxy-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Expires: Tue, 03 Jul 2001 06:00:00 GMT');
        $this->output->set_header('Last-Modified: ' . gmdate(DateTime::RFC2822) . ' GMT');

        $this->load->library('form_validation');
        if ($this->is_post()) {
            $this->index_handle_post();
        } else {

            $account = Stripe_Account::retrieve();
            $this->template->business_name = $account->business_name;
            $this->template->stripe_public_key = config_item('stripe_public_key');

            $this->template->content->view('welcome/test');
            $this->template->foot->view('welcome/index_script');
            $this->template->javascript->add('assets/js/bootstrapValidatorLibpay.js');
            $this->template->javascript->add('assets/js/libpay-validation.js');
            $this->template->javascript->add('assets/js/libpay.js');
            $this->template->publish();
        }
    }


    public function receipt()
    {
        $this->load->helper('stripe');
        $account = Stripe_Account::retrieve();

        // from Stripe
        $res = Stripe_Charge::retrieve("ch_15ZRJf48Q9PN7AwpARcCNlsp");

        // from the $_POST array
        $hshsl_details = (object)array
        	(
        	    'hshsl_category' => 'Library Fines',
        	    'hshsl_category_other' => '',
        	    'invoice_no' =>'',
        	    'hshsl_amount_dollar' => '12',
        	    'hshsl_amount_cents' => '34',
        	    'patron_name' => 'Testy McTesterson',
        	    'umid' => 'tmct',
        	    'phone' => '1231231234',
        	    'email' => 'test@example.com',
        	    'instruction' => '',
        	    'street' => '601 West Lombard St',
        	    'city' => 'Baltimore',
        	    'state' => 'MD',
        	    'zip' => '21201',
        	    'cardholdername' => 'Test McTesterson',
        	    'select2' => '2016',
        	    'stripeToken' => 'tok_15YIJt48Q9PN7Awpieo81xzl',
        	);
        $data['success'] = TRUE;
        $data['receipt'] = $res;
        $data['details'] = $hshsl_details;
        $data['account'] = $account;
        $this->template->content->view('welcome/receipt', $data);
        $this->template->publish();
    }


    // decline, cvc, expired, error
    public function index()
    {
        $this->output->set_header('Cache-Control: max-age=0, no-store, no-cache, must-revalidate, proxy-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Expires: Tue, 03 Jul 2001 06:00:00 GMT');
        $this->output->set_header('Last-Modified: ' . gmdate(DateTime::RFC2822) . ' GMT');

        $this->load->library('form_validation');
        if ($this->is_post()) {
            $this->index_handle_post();
        } else {

            $account = Stripe_Account::retrieve();
            $this->template->business_name = $account->business_name;
            $this->template->stripe_public_key = config_item('stripe_public_key');

            $this->template->content->view('test/index');
            $this->template->foot->view('welcome/index_script');
            $this->template->javascript->add('assets/js/bootstrapValidatorLibpay.js');
            $this->template->javascript->add('assets/js/libpay-validation.js');
            $this->template->javascript->add('assets/js/libpay.js');
            $this->template->publish();
        }
    }

    public function log()
    {
        echo '<pre>';
        $this->logger->all('all');
        $this->logger->trace('trace');
        $this->logger->debug('debug');
        $this->logger->info('info');
        $this->logger->warn('warn');
        $this->logger->error('error');
        $this->logger->fatal('fatal');
        $this->logger->log(LEVEL_SQL, 'select * from foo');
        echo '</pre>';
    }

}
