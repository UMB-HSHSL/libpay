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
            error_log('validation success');
        	$error = '';
        	$success = '';
        	
        	try {
        	    
        	    $this->session->set_flashdata('stripe_success', false);
        	    //@@        	    throw new Stripe_CardError;
        	    $token = Stripe_Token::retrieve($this->input->post('stripeToken'));
        	    if (! cc_valid_brand($token->card->brand)){
        	        $valid_brands = implode(", ", config_item('stripe_valid_brands'));
        	        throw new Exception("Sorry; we do not accept {$token->card->brand}. Please choose from the following: {$valid_brands}."); 
        	    }
        	    $stripe_res = Stripe_Charge::create(array(
        	        "amount" => ($this->input->post('hshsl_amount_dollar') * 100) + $this->input->post('hshsl_amount_cents'),
        	        "currency" => "usd",
           	        "card" => $this->input->post('stripeToken'),
        	        "description" => $this->input->post('hshsl_category'),
        	        "receipt_email" => $this->input->post('email')
        	    ));

        	    $this->session->set_flashdata('stripe_success', true); 
        	    
        	    // store the receipt ID only so we don't run over 4k in our cookie
        	    // we can retrieve the data in receipt handler
        	    $this->session->set_flashdata('stripe_id', $stripe_res->id);
        	    $this->session->set_flashdata('hshsl_details', (object) $_POST);
        	     
        	    $this->send_mail();
        	}
/*
        	 catch (Stripe_CardError $e) {
        	    
        	    $this->session->set_flashdata('stripe_exception', $e);
                // Since it's a decline, Stripe_CardError will be caught
                
            } catch (Stripe_InvalidRequestError $e) {
        	    $this->session->set_flashdata('stripe_exception', $e);
                // Invalid parameters were supplied to Stripe's API
            } catch (Stripe_AuthenticationError $e) {
                // Authentication with Stripe's API failed
                // (maybe you changed API keys recently)
        	    $this->session->set_flashdata('stripe_exception', $e);
            } catch (Stripe_ApiConnectionError $e) {
                // Network communication with Stripe failed
        	    $this->session->set_flashdata('stripe_exception', $e);
            } catch (Stripe_Error $e) {
                // Display a very generic error to the user, and maybe send
                // yourself an email
        	    $this->session->set_flashdata('stripe_exception', $e);
            } 
            */
            catch (Exception $e) {
                $str = json_encode($e); 
                error_log("ERROR: {$str}");
                /*
                print '<pre>' .  print_r($e, 1);
                
                $body = $e->getJsonBody();
                $err = $body['error'];
                
                print('Status is:' . $e->getHttpStatus() . "\n");
                print('Type is:' . $err['type'] . "\n");
                print('Code is:' . $err['code'] . "\n");
                // param is '' in this case
                print('Message is:' . $err['message'] . "\n");
                print '</pre>'; 
                
                exit;
                */
                // Something else happened, completely unrelated to Stripe
        	    $this->session->set_flashdata('stripe_exception', json_encode($e));
            }
            redirect('welcome/receipt');
            
        	
        } else {
            error_log('validation failure');
            $this->index_handle_get();
        }
    }

    private function send_mail()
    {
        /*
         * $to = $_POST["email"];
         * $receipt_to = $_POST["email"]; // sender
         * $subject = "HSHSL Payment Confirmation";
         * $hshsl_email = "cats@hshsl.umaryland.edu";
         * $to = "bkim@hshsl.umaryland.edu";
         * $message ="Thank you for your payment. Please retain this email as the receipt of your payment.";
         * $message.="\n\nYour Name: ".$_POST['patron_name'];
         * $message.="\nYour UMID: ".$_POST['umid'];
         * $message.="\nAmount: $";
         * $message.=$_POST['hshsl_amount_dollar'].".".$_POST['hshsl_amount_cents'];
         * $message.="\nCategory: ".$_POST['hshsl_category'];
         * $message.="\nInvoice No. (If Applicable): ".$_POST['invoice_no'];
         * $message.="\nSpecial Instructions. (If Applicable): ".$_POST['instruction'];
         * // message lines should not exceed 70 characters (PHP rule), so wrap it
         * $message = wordwrap($message, 70);
         * mail($to,$subject,$message,"From: $hshsl_email\n");
         */
    }

    /**
     * Show the receipt
     */
    public function receipt()
    {
        $this->load->helper('stripe');
        $account = Stripe_Account::retrieve();
        
        $data = array(
            'success' => false, 
            'details' => (object) array(),
            'receipt' => (object) array(), 
            'error' => 'There was an error. Please try again.',
            'account' => (object) array(), 
        ); 
        
        if ($receipt_id = $this->session->flashdata('stripe_id'))
        {
            $receipt = Stripe_Charge::retrieve($receipt_id);
            
            $data['success'] = $this->session->flashdata('stripe_success') || false;
            $data['details'] = $this->session->flashdata('hshsl_details');
            $data['receipt'] = $receipt;
            $data['error'] = json_decode($this->session->flashdata('stripe_exception'));
            $data['account'] = $account;
        }
        
        $this->template->content->view('welcome/receipt', $data); 
        $this->template->publish();
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
    
    
    public function test_receipt()
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
    
}
