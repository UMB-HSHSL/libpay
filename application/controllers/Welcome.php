<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'libraries/Stripe.php';

class Welcome extends MY_Controller
{

    public function index()
    {
        $this->output->set_header('Cache-Control: max-age=0, no-store, no-cache, must-revalidate, proxy-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Expires: Tue, 03 Jul 2001 06:00:00 GMT');
        $this->output->set_header('Last-Modified: ' . gmdate(DateTime::RFC2822) . ' GMT');
        
        $this->load->library('form_validation');
        if ($this->is_post()) {
            $this->index_handle_post();
            redirect('welcome/receipt');
        } else {
        	$this->index_handle_get();
        }
    }

    /**
     * Show the payment form
     */
    private function index_handle_get()
    {
        Stripe::setApiKey(config_item('STRIPE_SECRET_KEY'));
        $account = Stripe_Account::retrieve();
        $this->template->business_name = $account->business_name; 
        $this->template->stripe_public_key = config_item('STRIPE_PUBLIC_KEY');
        
        $this->template->content->view('welcome/index');
        $this->template->foot->view('welcome/index_script');
        $this->template->javascript->add('assets/js/libpay-validation.js');
        $this->template->publish();
    }

    /**
     * Handle a payment submission.
     * On validation error redisplay the form;
     * otherwise show the receipt. Stripe errors will be displayed on the
     * receipt page as well.
     */
    public function index_handle_post()
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
            Stripe::setApiKey(config_item('STRIPE_SECRET_KEY'));
        	$error = '';
        	$success = '';
        	
        	try {
        	    $this->session->set_flashdata('stripe_success', false);

        	    $stripe_res = Stripe_Charge::create(array(
        	        "amount" => ($this->input->post('hshsl_amount_dollar') * 100) + $this->input->post('hshsl_amount_cents'),
        	        "currency" => "usd",
           	        "card" => $this->input->post('stripeToken'),
        	        "description" => $this->input->post('hshsl_category'),
        	        "receipt_email" => $this->input->post('email')
        	    ));
        	    
        	    $this->session->set_flashdata('stripe_success', true); 
        	    $this->session->set_flashdata('stripe_response', $stripe_res->__toJSON());

        	    $this->send_mail();
        	    
        	} catch (Stripe_CardError $e) {
        	    
                // Since it's a decline, Stripe_CardError will be caught
                $body = $e->getJsonBody();
                $err = $body['error'];
                
                print('Status is:' . $e->getHttpStatus() . "\n");
                print('Type is:' . $err['type'] . "\n");
                print('Code is:' . $err['code'] . "\n");
                // param is '' in this case
                print('Param is:' . $err['param'] . "\n");
                print('Message is:' . $err['message'] . "\n");
            } catch (Stripe_InvalidRequestError $e) {
                // Invalid parameters were supplied to Stripe's API
            } catch (Stripe_AuthenticationError $e) {
                // Authentication with Stripe's API failed
                // (maybe you changed API keys recently)
            } catch (Stripe_ApiConnectionError $e) {
                // Network communication with Stripe failed
            } catch (Stripe_Error $e) {
                // Display a very generic error to the user, and maybe send
                // yourself an email
            } catch (Exception $e) {
                // Something else happened, completely unrelated to Stripe
            }
        	
        } else {
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
        Stripe::setApiKey(config_item('STRIPE_SECRET_KEY'));
        $account = Stripe_Account::retrieve();
                
        $data['success'] = $this->session->flashdata('stripe_success');
        $data['receipt'] = json_decode($this->session->flashdata('stripe_response'));
        $data['account'] = $account;
        
        $this->template->content->view('welcome/receipt', $data); 
        $this->template->publish();
    }
    
    
    
    public function test()
    {
        $this->load->helper('stripe');
        Stripe::setApiKey(config_item('STRIPE_SECRET_KEY'));
        $account = Stripe_Account::retrieve();
         
        $res = json_decode('{ "object": "charge", "created": 1424121383, "livemode": false, "paid": true, "amount": 1234, "currency": "usd", "refunded": false, "captured": true, "card": { "object": "card", "last4": "1111", "brand": "Visa", "funding": "unknown", "exp_month": 2, "exp_year": 2016, "fingerprint": "og9xepLg7fcWwEW4", "country": "US", "name": null, "address_line1": null, "address_line2": null, "address_city": null, "address_state": null, "address_zip": null, "address_country": null, "cvc_check": "pass", "address_line1_check": null, "address_zip_check": null, "dynamic_last4": null, "customer": null }, "balance_transaction": "txn_15WwE748Q9PN7AwpyaB2KWpr", "failure_message": null, "failure_code": null, "amount_refunded": 0, "customer": null, "invoice": null, "description": "Library Fines", "dispute": null, "metadata": [], "statement_descriptor": null, "fraud_details": [], "receipt_email": "zburke@hshsl.umaryland.edu", "receipt_number": null, "shipping": null, "refunds": { "object": "list", "total_count": 0, "has_more": false, "url": "\/v1\/charges\/ch_15WwE748Q9PN7AwpKur58pDj\/refunds", "data": [] }, "statement_description": null }');
        $data['success'] = TRUE;
        $data['receipt'] = $res;
        $data['account'] = $account;
        $this->template->content->view('welcome/receipt', $data);
        $this->template->publish();
        
    }
}
