<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    public function index()
    {
    	error_log('request_method: ' . $this->input->method()); 
    	
        $this->output->set_header('Cache-Control: max-age=0, no-store, no-cache, must-revalidate, proxy-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Expires: Tue, 03 Jul 2001 06:00:00 GMT');
        $this->output->set_header('Last-Modified: ' . gmdate(DateTime::RFC2822) . ' GMT');
        
        $this->load->library('form_validation');
        if ('post' == $this->input->method()) {
        	error_log('post');
            $this->index_handle_post();
        } else {
        	error_log('get');
        	$this->index_handle_get();
        }
    }

    /**
     * Show the payment form
     */
    private function index_handle_get()
    {
        $this->template->stripe_public_key = config_item('STRIPE_PUBLIC_KEY');

        $this->template->content->view('welcome/index');
        $this->template->foot->view('welcome/index_script');
        $this->template->javascript->add('js/libpay-validation.js');
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
//        	    if (! isset($_POST['stripeToken'])) {
//@@        	        throw new Exception("The Stripe Token was not generated correctly");
//        	    }
        	    $stripe_res = Stripe_Charge::create(array(
        	        "amount" => ($this->input->post('hshsl_amount_dollar') * 100) + $this->input->post('hshsl_amount_cents'),
        	        "currency" => "usd",
        	        "card" => $this->input->post('stripeToken'),
        	        "description" => $this->input->post('hshsl_category'),
        	        "receipt_email" => $this->input->post('email')
        	    ));
        	    
        	    $_SESSION['stripe_response'] = $stripe_res; 
        	    
        	    error_log($this->input->post('email'));
        	    $success = '<div class="alert alert-success">
<strong>Success!</strong> Your payment of $' . $_POST['hshsl_amount_dollar'] . '.' . $_POST['hshsl_amount_cents'] . ' was successful. The confirmation e-mail will be sent to ' . $_POST['email'] . '.</div>' . $_POST['email'];
        	
        	    // $headers = "From: $hshsl_email\n";
        	    // mail($to,$subject,$message,$headers);
        	} catch (Exception $e) {
        	    $error = '<div class="alert alert-danger"><strong>Error!</strong> ' . $e->getMessage() . '  </div>';
        	} // catch
        	        	
        	
            
            $this->send_mail();
            redirect('welcome/receipt');
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
    	$data['stripe_response'] = $_SESSION['stripe_response'];
        $this->template->content->view('welcome/receipt', $data); 
        $this->template->publish();
    }
}
